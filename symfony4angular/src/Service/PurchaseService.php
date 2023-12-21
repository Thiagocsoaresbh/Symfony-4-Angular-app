<?php

namespace App\Service;

use App\Entity\Purchase;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class PurchaseService
{
    private PurchaseRepository $purchaseRepository;
    private EntityManagerInterface $entityManager;
    private PaginatorInterface $paginator;

    public function __construct(PurchaseRepository $purchaseRepository, EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
    }

    public function createPurchase(array $purchaseData): ?Purchase
    {
        // Validations to ensure that all necessary fields are present
        $requiredFields = ['customer', 'status', 'date', 'address1', 'city', 'postcode', 'country', 'amount'];
        foreach ($requiredFields as $field) {
            if (!isset($purchaseData[$field])) {
                throw new \InvalidArgumentException("Campo '$field' ausente nos dados de compra.");
            }
        }

        // Validation for date format
        try {
            $date = new \DateTime($purchaseData['date']);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Formato de data inválido: {$purchaseData['date']}");
        }

        // Creating the Purchase Entity
        $purchase = new Purchase();
        $purchase->setCustomer($purchaseData['customer']);
        $purchase->setStatus($purchaseData['status']);
        $purchase->setDate($date);
        $purchase->setAddress($purchaseData['address1']);
        $purchase->setCity($purchaseData['city']);
        $purchase->setPostcode($purchaseData['postcode']);
        $purchase->setCountry($purchaseData['country']);
        $purchase->setAmount($purchaseData['amount']);

        // Trying to persist and handle errors
        try {
            $this->entityManager->persist($purchase);
            $this->entityManager->flush();
            return $purchase;
        } catch (\Exception $e) {
            // Handle errors later if needed
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

    public function getAllPurchasesPaginated(int $page, int $pageSize): PaginationInterface
    {
        $purchases = $this->purchaseRepository->findAll();

        return $this->paginator->paginate(
            $purchases, // Origin of data
            $page,      // Page number
            $pageSize   // Items per page
        );
    }
}
