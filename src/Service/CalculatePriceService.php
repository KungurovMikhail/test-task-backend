<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CalculatePriceRequestDTO;
use App\DTO\PurchaseRequestDTO;
use App\Enum\CouponTypes;
use App\Exception\NotFoundException;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;

final readonly class CalculatePriceService
{
    public function __construct(
        private ProductRepository $productRepository,
        private CouponRepository $couponRepository,
        private TaxRepository $taxRepository,
    ){}

    public function calculate(CalculatePriceRequestDTO $dto): float
    {
        $product = $this->productRepository->find($dto->product);

        if (!$product) {
            throw new NotFoundException('Product not found');
        }

        $tax = $this->taxRepository->findOneBy(['countryCode' => substr($dto->taxNumber, 0, 2)]);

        if (!$tax) {
            throw new NotFoundException('Tax number not found');
        }

        $price = $product->getPrice() + ($product->getPrice() / 100 * $tax->getPercent());

        $discount = 0;
        if ($dto->couponCode) {
            $coupon = $this->couponRepository->findOneBy(['code' => $dto->couponCode]);

            if (!$coupon) {
                throw new NotFoundException('Coupon not found');
            }

            if ($coupon->getType() === CouponTypes::Percent) {
                $discount = $price * $coupon->getValue();
            } elseif ($coupon->getType() === CouponTypes::Fixed) {
                $discount = $coupon->getValue();
            }
        }

        if ($discount > $price) {
            throw new NotFoundException('The coupon cannot be applied');
        }

        return $price - $discount;
    }
}
