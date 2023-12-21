<?php

namespace App\Controller;

use App\Service\PurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController
{
    #[Route('/create-purchase', name: 'create_purchase')]
    public function createPurchase(PurchaseService $purchaseService): Response
    {
        $purchaseData = [
            'customer' => 'Aphrodite Olson',
            'status' => 'in_production',
            'date' => '2019-12-14 19:32:45',
            'address1' => '5104 Ipsum. Rd.',
            'city' => 'Busan',
            'postcode' => '778606',
            'country' => 'Azerbaijan',
            'amount' => 4869,
        ];

        $purchase = $purchaseService->createPurchase($purchaseData);

        return $this->json(['message' => 'Purchase created successfully', 'purchase_id' => $purchase->getId()]);
    }

    #[Route('/update-purchase-status/{purchaseId}/{newStatus}', name: 'update_purchase_status')]
    public function updatePurchaseStatus(PurchaseService $purchaseService, int $purchaseId, string $newStatus): Response
    {
        $purchase = $purchaseService->getPurchaseById($purchaseId);

        if (!$purchase) {
            return $this->json(['error' => 'Purchase not found'], 404);
        }

        $purchaseService->updatePurchaseStatus($purchase, $newStatus);

        return $this->json(['message' => 'Purchase status updated successfully']);
    }

    #[Route('/list-purchases', name: 'list_purchases')]
    public function listPurchases(PurchaseService $purchaseService): Response
    {
        $purchases = $purchaseService->getAllPurchases();

        return $this->json(['purchases' => $purchases]);
    }
}
