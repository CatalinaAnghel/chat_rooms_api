<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidAttribute extends Constraint
{
    public $message = 'This is not a valid attribute';
}