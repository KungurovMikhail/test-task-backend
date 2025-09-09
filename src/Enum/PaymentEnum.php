<?php

declare(strict_types=1);

namespace App\Enum;

enum PaymentEnum: string
{
    case Paypal = 'paypal';
    case Stripe = 'stripe';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

