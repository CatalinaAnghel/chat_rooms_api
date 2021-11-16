<?php

namespace App\Validator\Constraints;

use App\Dto\ChatRooms\Input\ChatRoomsInputDto;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class ValidAttributeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        $reflectionClass = new \ReflectionClass(ChatRoomsInputDto::class);
        $properties = $reflectionClass->getProperties();
        $attributes = array();
        foreach ($properties as $property){
            $attributes[] = $property->getName();
        }

        if (!in_array($value, $attributes)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}