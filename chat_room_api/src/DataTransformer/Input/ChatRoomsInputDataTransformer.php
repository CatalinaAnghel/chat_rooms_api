<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\ChatRooms\Input\ChatRoomsInputDto;
use App\Dto\ChatRoomsCriteriaDelete\Input\ChatRoomsCriteriaDelete;
use App\Entity\ChatRooms;

final class ChatRoomsInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $chatRoom = new ChatRooms();

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