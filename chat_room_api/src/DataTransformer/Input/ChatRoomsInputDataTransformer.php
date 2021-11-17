<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\ChatRooms;
use Doctrine\ORM\EntityManagerInterface;

final class ChatRoomsInputDataTransformer implements DataTransformerInterface
{
    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManager;
    }
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $this->validator->validate($data);
        if(isset($context['item_operation_name']) && $context['item_operation_name'] == 'put'){
            $repo = $this->entityManager->getRepository('App\Entity\ChatRooms');
            $chatRoom = $repo->findOneBy(['id' => $context['object_to_populate']->getId()]);
        }else{
            $chatRoom = new ChatRooms();
        }

        $chatRoom->setName($data->getName());

        return $chatRoom;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof ChatRooms) {
            return false;
        }
        return ChatRooms::class === $to && null !== ($context['input']['class'] ?? null);
    }
}