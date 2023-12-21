<?php

namespace App\Command;

use App\Entity\Purchase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ImportPurchasesCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setName('app:import-purchases')
            ->setDescription('Import purchases from purchases.json')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to purchases.json file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('file');
        $purchasesData = json_decode(file_get_contents($filePath), true);

        foreach ($purchasesData as $purchaseData) {
            $purchase = new Purchase();
            $purchase->setId($purchaseData['id']);
            $purchase->setDate(new \DateTime($purchaseData['date']));
            $purchase->setCustomer($purchaseData['customer']);
            $purchase->setAddress($purchaseData['address1']);
            $purchase->setCity($purchaseData['city']);
            $purchase->setPostcode($purchaseData['postcode']);
            $purchase->setCountry($purchaseData['country']);
            $purchase->setAmount($purchaseData['amount']);
            $purchase->setStatus($purchaseData['status']);
            $purchase->setDeleted($purchaseData['deleted'] ?? false);
            $purchase->setLastModified(isset($purchaseData['last_modified']) ? new \DateTime($purchaseData['last_modified']) : null);

            $this->entityManager->persist($purchase);
        }

        $this->entityManager->flush();

        $output->writeln('Orders imported successfully.');

        return Command::SUCCESS;
    }
}
