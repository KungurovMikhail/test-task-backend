<?php

declare(strict_types=1);

namespace App\Enum;

enum CouponTypes: string
{
    case Percent = 'percent';
    case Fixed = 'fixed';
}

