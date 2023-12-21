<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PurchaseControllerTest extends WebTestCase
{
    public function testCreatePurchase()
    {
        $client = static::createClient();

        $client->request('POST', '/create-purchase');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('purchase_id', $responseData);
    }

    public function testListPurchases()
    {
        $client = static::createClient();

        $client->request('GET', '/list-purchases');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('purchases', $responseData);
    }

    public function testUpdatePurchaseStatus()
    {
        $client = static::createClient();

        // Adapte o ID da compra e o novo status conforme necessário
        $client->request('PUT', '/update-purchase-status/1/shipped');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
    }
}
