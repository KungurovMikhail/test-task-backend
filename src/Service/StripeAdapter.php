<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\PaymentException;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

final readonly class StripeAdapter implements PaymentInterface
{
    public function __construct(
        private StripePaymentProcessor $stripePaymentProcessor,
    ){}

    public function getName(): string
    {
        return 'stripe';
    }

    public function pay(float $price): void
    {
        if (!$this->stripePaymentProcessor->processPayment($price)) {
            throw new PaymentException('Stripe payment failed');
        }
    }
}
