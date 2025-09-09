<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/calculate-price',
    name: 'calculate-price',
    methods: ['POST']
)]
final class CalculatePriceController extends AbstractController
{
    public function __construct(

    ){}

    public function __invoke(): Response
    {

        return $this->json([]);
    }
}
