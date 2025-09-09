<?php

namespace App\DTO;

use App\Enum\PaymentEnum;
use App\Validator\Constraints\TaxNumber;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequestDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        public int $product,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[TaxNumber]
        public string $taxNumber,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Choice(
            callback: [PaymentEnum::class, 'getValues'],
            message: 'Invalid payment processor'
        )]
        public string $paymentProcessor,
        #[Assert\Type('string')]
        public ?string $couponCode
    ) {}
}
