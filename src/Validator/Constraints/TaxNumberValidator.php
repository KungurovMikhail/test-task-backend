<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        //for all countries
        $patterns = [
            'DE' => '/^DE\d{9}$/',
            'IT' => '/^IT\d{11}$/',
            'GR' => '/^GR\d{9}$/',
            'FR' => '/^FR[A-Z]{2}\d{9}$/',
        ];

        $countryCode = $this->getCountryByTaxNumber($value);

        if (!isset($patterns[$countryCode]) || preg_match($patterns[$countryCode], $value) !== 1) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function getCountryByTaxNumber(string $taxNumber): ?string
    {
        return substr($taxNumber, 0, 2);
    }
}
