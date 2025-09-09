<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\NotFoundException;

readonly class PaymentProcessorResolver
{
    /**
     * @param iterable<PaymentInterface> $processors
     */
    public function __construct(
        private iterable $processors
    ){}

    public function resolve(string $name): PaymentInterface
    {
        foreach ($this->processors as $processor) {
            if ($processor->getName() === $name) {
                return $processor;
            }
        }

        throw new NotFoundException('Payment processor "' . $name . '" not found');
    }
}
