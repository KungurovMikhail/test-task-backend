<?php

namespace App\Service;

interface PaymentInterface
{
    public function getName(): string;
    public function pay(float $price): void;
}
