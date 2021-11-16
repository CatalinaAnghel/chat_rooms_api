<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\ChatRooms\Output\ChatRoomsOutputDto;

class ChatRoomsOutputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $chatRoom = new ChatRoomsOutputDto();

        $chatRoom->setName($data->getName());
        $chatRoom->setId($data->getId());

        return $chatRoom;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof ChatRoomsOutputDto) {
            return false;
        }

        return ChatRoomsOutputDto::class === $to && null !== ($context['input']['class'] ?? null);
    }
}