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

    public function createPurchase(array $purchaseData): ?Purchase
    {
        // Validations do graant that all necessary fields are there
        $requiredFields = ['customer', 'status', 'date', 'address1', 'city', 'postcode', 'country', 'amount'];
        foreach ($requiredFields as $field) {
            if (!isset($purchaseData[$field])) {
                throw new \InvalidArgumentException("Campo '$field' ausente nos dados de compra.");
            }
        }

        // Validation to date format
        try {
            $date = new \DateTime($purchaseData['date']);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Formato de data inválido: {$purchaseData['date']}");
        }

        // Creatinf the Entity Purchase
        $purchase = new Purchase();
        $purchase->setCustomer($purchaseData['customer']);
        $purchase->setStatus($purchaseData['status']);
        $purchase->setDate($date);
        $purchase->setAddress($purchaseData['address1']);
        $purchase->setCity($purchaseData['city']);
        $purchase->setPostcode($purchaseData['postcode']);
        $purchase->setCountry($purchaseData['country']);
        $purchase->setAmount($purchaseData['amount']);

        // Trying persist and deal with erros
        try {
            $this->entityManager->persist($purchase);
            $this->entityManager->flush();
            return $purchase;
        } catch (\Exception $e) {
            // Treatment about error later if neede it
            return null;
        }
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
