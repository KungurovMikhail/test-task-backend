<?php

declare(strict_types=1);

namespace App\Service;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

final readonly class PaypalAdapter implements PaymentInterface
{
    public function __construct(
        private PaypalPaymentProcessor $paypalPaymentProcessor,
    ){}

    public function getName(): string
    {
        return 'paypal';
    }

    public function pay(float $price): void
    {
        $this->paypalPaymentProcessor->pay((int) round($price * 100));
    }
}
