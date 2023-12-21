<?php

namespace App\Tests\Entity;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->validator = $container->get('validator');
    }
    #[Assert\NotBlank]
    public function testValidCustomer(): void
    {
        $customer = (new Customer())
            ->setName('John Doe')
            ->setEmail('john.doe@example.com');

        $errors = $this->validator->validate($customer);

        $this->assertCount(0, $errors);
        dump('Validate Customer Test Passed');
    }

    public function testInvalidCustomer(): void
    {
        $customer = new Customer();

        $errors = $this->validator->validate($customer);

        $this->assertCount(2, $errors);
        $this->assertStringContainsString('Name is required', $errors->get(0)->getMessage());
        $this->assertStringContainsString('Email is required', $errors->get(1)->getMessage());

        dump('Customer required Name Email Test Passed');
    }
}
