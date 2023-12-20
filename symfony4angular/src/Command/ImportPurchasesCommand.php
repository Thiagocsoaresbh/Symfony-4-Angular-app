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
            $purchase->setCustomer($purchaseData['customer']);
            $purchase->setStatus($purchaseData['status']);

            $this->entityManager->persist($purchase);
        }

        $this->entityManager->flush();

        $output->writeln('Orders imported successfully.');

        return Command::SUCCESS;
    }
}
