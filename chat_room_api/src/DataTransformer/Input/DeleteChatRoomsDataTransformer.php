<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\CriteriaDeleteChatRooms;

final class DeleteChatRoomsDataTransformer implements DataTransformerInterface
{
    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $this->validator->validate($data);
        foreach ($data->getFilters() as $filter){
            $this->validator->validate($filter);
        }

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
        if ($data instanceof CriteriaDeleteChatRooms) {
            return false;
        }

        return CriteriaDeleteChatRooms::class === $to && null !== ($context['input']['class'] ?? null);
    }
}