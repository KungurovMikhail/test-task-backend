<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends HttpException
{
    public function __construct(private readonly ConstraintViolationListInterface $violations)
    {
        parent::__construct(
            422,
            sprintf('Validation failed: %s', $this->violations->get(0)->getMessage())
        );
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
