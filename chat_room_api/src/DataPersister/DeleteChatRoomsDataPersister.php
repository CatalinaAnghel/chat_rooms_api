<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Dto\ChatRooms\Output\ChatRoomsOutputDto;
use App\Dto\ChatRoomsCriteriaDelete\Output\ChatRoomsCriteriaDelete;
use App\Entity\CriteriaDeleteChatRooms;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class DeleteChatRoomsDataPersister implements DataPersisterInterface, ContextAwareDataPersisterInterface
{
    const CHAT_ROOMS_ALIAS = 'chat_rooms_alias';
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof CriteriaDeleteChatRooms;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        if (!empty($context['collection_operation_name']) && $context['collection_operation_name'] == 'post') {
            $results = $this->remove($data);
            $criteria = new ChatRoomsCriteriaDelete();
            $criteria->setIsPreview($data->isPreview());
            $criteria->setSample($results);
        }
        return !empty($criteria)? $criteria : [];
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->addSelect(self::CHAT_ROOMS_ALIAS . '.id');
        $qb->from('App\Entity\ChatRooms', self::CHAT_ROOMS_ALIAS);
        foreach ($data->getFilters() as $filter) {
            // matching using regex (partial matching)
            if($filter->isIncluded()){
                $qb->andWhere(
                    "REGEXP(".self::CHAT_ROOMS_ALIAS . "." . $filter->getAttribute().", '". $filter->getValue() ."') = true"
                );
            }else{
                $qb->andWhere(
                    "REGEXP(".self::CHAT_ROOMS_ALIAS . "." . $filter->getAttribute().", '". $filter->getValue() ."') = false"
                );
            }

        }

        if($data->isPreview()){
            $qb->setMaxResults(100);
        }
        $qb->distinct();
        $results = $qb->getQuery()->getArrayResult();
        $filteredResources = array();
        if (!$data->isPreview()) {
            $this->entityManager->beginTransaction();
        }
        foreach ($results as $result) {
            $object = $this->entityManager->getRepository('App\Entity\ChatRooms')
                ->findOneBy(['id' => $result['id']]);
            $chatRoomOutputDto = new ChatRoomsOutputDto();
            $chatRoomOutputDto->setId($object->getId());
            $chatRoomOutputDto->setName($object->getName());
            $filteredResources[] = $chatRoomOutputDto;
            if (!$data->isPreview()){
                $this->entityManager->remove($object);
            }

        }
        try{
            if (!$data->isPreview()){
                $this->entityManager->flush();
                $filteredResources = [];
                $this->entityManager->getConnection()->commit();
            }
        }catch (Exception $e){
            $this->entityManager->getConnection()->rollBack();
        }

        return $filteredResources;
    }
}