<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\CriteriaDeleteChatRooms;

final class DeleteChatRoomsDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $criteria = new CriteriaDeleteChatRooms();

        $criteria->setPreview($data->getPreview());

        $criteria->setFilters($data->getFilters());
        return $criteria;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof CriteriaDeleteChatRooms) {
            return false;
        }

        return CriteriaDeleteChatRooms::class === $to && null !== ($context['input']['class'] ?? null);
    }
}