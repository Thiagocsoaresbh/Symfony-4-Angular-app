<?php

namespace App\Service;

use App\Entity\Purchase;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;

class PurchaseService
{
    private PurchaseRepository $purchaseRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PurchaseRepository $purchaseRepository, EntityManagerInterface $entityManager)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->entityManager = $entityManager;
    }

    public function createPurchase(array $purchaseData): Purchase
    {
        $purchase = new Purchase();
        $purchase->setCustomer($purchaseData['customer']);
        $purchase->setStatus($purchaseData['status']);
        $purchase->setDate(new \DateTime($purchaseData['date']));
        $purchase->setAddress($purchaseData['address1']);
        $purchase->setCity($purchaseData['city']);
        $purchase->setPostcode($purchaseData['postcode']);
        $purchase->setCountry($purchaseData['country']);
        $purchase->setAmount($purchaseData['amount']);

        $this->entityManager->persist($purchase);
        $this->entityManager->flush();

        return $purchase;
    }

    public function updatePurchaseStatus(Purchase $purchase, string $newStatus): void
    {
        $purchase->setStatus($newStatus);

        $this->entityManager->flush();
    }

    public function getAllPurchases(): array
    {
        return $this->purchaseRepository->findAll();
    }

    public function getPurchaseById(int $purchaseId): ?Purchase
    {
        return $this->purchaseRepository->find($purchaseId);
    }
}
