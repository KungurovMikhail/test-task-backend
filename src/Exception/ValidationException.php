<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{
    public function __construct(private readonly ConstraintViolationListInterface $violations)
    {
        parent::__construct(sprintf('Validation failed: %s', $this->violations->get(0)->getMessage()), 422);
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
