<?php

declare(strict_types=1);

namespace App\Controller;

use App\ArgumentResolver\RequestBodyArgumentResolver;
use App\DTO\CalculatePriceRequestDTO;
use App\Service\CalculatePriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/calculate-price',
    name: 'calculate-price',
    methods: ['POST']
)]
final class CalculatePriceController extends AbstractController
{
    public function __construct(
        private readonly CalculatePriceService $calculatePriceService,
    ){}

    public function __invoke(#[ValueResolver(RequestBodyArgumentResolver::class)] CalculatePriceRequestDTO $dto): Response
    {
        return $this->json($this->calculatePriceService->calculate($dto));
    }
}
