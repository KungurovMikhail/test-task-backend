<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use App\Enum\CouponTypes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadProducts($manager);
        $this->loadCoupons($manager);
        $this->loadTaxs($manager);
        $manager->flush();
    }

    private function loadProducts(ObjectManager $manager): void
    {
        $products = [
            ['name' => 'Iphone', 'price' => 100, 'currency' => 'EUR'],
            ['name' => 'Наушники', 'price' => 20, 'currency' => 'EUR'],
            ['name' => 'Чехол', 'price' => 10, 'currency' => 'EUR'],
        ];

        foreach ($products as $elem) {
            $product = new Product();
            $product
                ->setName($elem['name'])
                ->setPrice($elem['price'])
                ->setCurrency($elem['currency']);

            $manager->persist($product);
        }
    }

    private function loadCoupons(ObjectManager $manager): void
    {
        $coupons = [
            ['code' => 'P10', 'type' => CouponTypes::Percent, 'value' => '0.1'],
            ['code' => 'P25', 'type' => CouponTypes::Percent, 'value' => '0.25'],
            ['code' => 'P100', 'type' => CouponTypes::Percent, 'value' => '1'],
            ['code' => 'F300', 'type' => CouponTypes::Fixed, 'value' => '300'],
            ['code' => 'F10', 'type' => CouponTypes::Fixed, 'value' => '10'],
        ];

        foreach ($coupons as $elem) {
            $coupon = new Coupon();
            $coupon
                ->setCode($elem['code'])
                ->setType($elem['type'])
                ->setValue($elem['value']);

            $manager->persist($coupon);
        }
    }

    private function loadTaxs(ObjectManager $manager): void
    {
        $taxs = [
            ['country_code' => 'DE', 'percent' => '19'],
            ['country_code' => 'IT', 'percent' => '22'],
            ['country_code' => 'GR', 'percent' => '20'],
            ['country_code' => 'FR', 'percent' => '24'],
        ];

        foreach ($taxs as $elem) {
            $tax = new Tax();
            $tax
                ->setCountryCode($elem['country_code'])
                ->setPercent($elem['percent']);

            $manager->persist($tax);
        }
    }
}
