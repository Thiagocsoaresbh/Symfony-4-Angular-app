<?php

namespace App\Controller;

use App\Service\PurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PurchaseController extends AbstractController
{
    private PurchaseService $purchaseService;
    private const CREATE_PURCHASE_ROUTE = '/create-purchase';
    private const UPDATE_PURCHASE_STATUS_ROUTE = '/update-purchase-status/{purchaseId}/{newStatus}';
    private const LIST_PURCHASES_ROUTE = '/list-purchases';

    #[Route(self::CREATE_PURCHASE_ROUTE, name: 'create_purchase')]
    public function createPurchase(PurchaseService $purchaseService): Response
    {
        $purchaseAttributes = [
            'customer' => 'Aphrodite Olson',
            'status' => 'in_production',
            'date' => '2019-12-14 19:32:45',
            'address1' => '5104 Ipsum. Rd.',
            'city' => 'Busan',
            'postcode' => '778606',
            'country' => 'Azerbaijan',
            'amount' => 4869,
        ];

        $purchase = $purchaseService->createPurchase($purchaseAttributes);

        return $this->json(['message' => 'Purchase created successfully', 'purchase_id' => $purchase->getId()]);
    }

    #[Route(self::UPDATE_PURCHASE_STATUS_ROUTE, name: 'update_purchase_status')]
    public function updatePurchaseStatus(PurchaseService $purchaseService, int $purchaseId, string $newStatus): Response
    {
        $purchase = $purchaseService->getPurchaseById($purchaseId);

        if (!$purchase) {
            return $this->json(['error' => 'Purchase not found'], Response::HTTP_NOT_FOUND);
        }

        $purchaseService->updatePurchaseStatus($purchase, $newStatus);

        return $this->json(['message' => 'Purchase status updated successfully']);
    }


    #[Route('/list-purchases', name: 'list_purchases')]
    public function listPurchases(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $pageSize = $request->query->getInt('pageSize', 10);

        $purchases = $this->purchaseService->getAllPurchasesPaginated($page, $pageSize);

        return $this->render('purchase/list_purchases.html.twig', [
            'purchases' => $purchases,
        ]);
    }
}
