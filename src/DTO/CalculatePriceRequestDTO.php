<?php

namespace App\DTO;

use App\Validator\Constraints\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class CalculatePriceRequestDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        public int $product,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[TaxNumber]
        public string $taxNumber,
        #[Assert\Type('string')]
        public ?string $couponCode
    ) {}
}
