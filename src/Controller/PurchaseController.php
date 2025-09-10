<?php

declare(strict_types=1);

namespace App\Controller;

use App\ArgumentResolver\RequestBodyArgumentResolver;
use App\DTO\PurchaseRequestDTO;
use App\Exception\PaymentException;
use App\Service\PurchaseService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/purchase',
    name: 'purchase',
    methods: ['POST']
)]
final class PurchaseController extends AbstractController
{
    public function __construct(
        private readonly PurchaseService $purchaseService,
        private readonly LoggerInterface $logger,
    ){}

    public function __invoke(#[ValueResolver(RequestBodyArgumentResolver::class)] PurchaseRequestDTO $dto): Response
    {
        //вынести всe Exceptions в лисенер, добавить общие исключения и т.д
        try {
            $this->purchaseService->purchase($dto);

            return $this->json([]);
        } catch (PaymentException $e) {
            $this->logger->error($e->getMessage());

            return $this->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_PAYMENT_REQUIRED);
        }
    }
}
