<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Dto\Output\ChatRoomsCriteriaDelete;
use App\Entity\CriteriaDeleteChatRooms;
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
        return (!empty($criteria) && $criteria->isPreview())? $criteria : [];
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
            if ($filter->isIncluded()) {
                if (preg_match('#[^\\\%](%|.)#', $filter->getAttribute())) {
                    // matching using regex (partial matching)
                    $qb->andWhere(
                        $qb->expr()->like(
                            self::CHAT_ROOMS_ALIAS . '.' . $filter->getAttribute(),
                            ':value'
                        )
                    );
                } else {
                    // exact matching
                    $qb->andWhere(
                        $qb->expr()->eq(
                            self::CHAT_ROOMS_ALIAS . '.' . $filter->getAttribute(),
                            ':value'
                        )
                    );
                }

            } else {
                if (preg_match('#[^\\\%](%|.)#', $filter->getAttribute())) {
                    // matching using regex (partial matching)
                    $qb->andWhere(
                        $qb->expr()->not(
                            $qb->expr()->like(
                                self::CHAT_ROOMS_ALIAS . '.' . $filter->getAttribute(),
                                ':value'
                            )
                        )
                    );
                } else {
                    // exact matching
                    $qb->andWhere(
                        $qb->expr()->neq(
                            self::CHAT_ROOMS_ALIAS . '.' . $filter->getAttribute(),
                            ':value'
                        )
                    );
                }
            }
            $qb->setParameter('value', $filter->getValue());
        }
        $results = $qb->getQuery()->getArrayResult();
        $filteredResources = array();
        foreach ($results as $result) {
            $object = $this->entityManager->getRepository('App\Entity\ChatRooms')->findOneBy(['id' => $result['id']]);
            $filteredResources[] = $object;
            if (!$data->isPreview())
                $this->entityManager->remove($object);
        }
        if (!$data->isPreview())
            $this->entityManager->flush();

        return $filteredResources;
    }
}