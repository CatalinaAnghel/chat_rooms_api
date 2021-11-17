<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\ChatRooms;
use App\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;

class MessagesInputDataTransformer implements DataTransformerInterface
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
            $repo = $this->entityManager->getRepository('App\Entity\Messages');
            $message = $repo->findOneBy(['id' => $context['object_to_populate']->getId()]);
        }else{
            $message = new Messages();
        }
        $message->setContent($data->getContent());
        $message->setChatRoom($data->getChatRoom());
        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Messages) {
            return false;
        }

        return Messages::class === $to && null !== ($context['input']['class'] ?? null);
    }
}