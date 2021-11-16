<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Messages;

class MessagesInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $message = new Messages();

        $message->setContent($data->getContent());
        $message->setChatRoom($data->getChatRoom());
        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Messages) {
            return false;
        }

        return Messages::class === $to && null !== ($context['input']['class'] ?? null);
    }
}