<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculatePriceRequestDTO;
use App\DTO\PurchaseRequestDTO;

final readonly class PurchaseService
{
    public function __construct(
        private CalculatePriceService $calculatePriceService,
        private PaymentProcessorResolver $resolver,
    ){}

    public function purchase(PurchaseRequestDTO $dto): void
    {
        $price = $this->calculatePriceService->calculate(new CalculatePriceRequestDTO($dto->product, $dto->taxNumber, $dto->couponCode));

        $paymentMethod = $this->resolver->resolve($dto->paymentProcessor);

        $paymentMethod->pay($price);
    }
}
