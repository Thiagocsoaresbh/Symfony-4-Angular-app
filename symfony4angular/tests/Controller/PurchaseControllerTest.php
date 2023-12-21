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

        // Simulate creation of purchase to get the ID
        $client->request('POST', '/create-purchase');
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $purchaseId = $responseData['purchase_id'];

        $newStatus = 'cancelled';

        // Update the status of purchase that has be just created
        $client->request('PUT', "/update-purchase-status/{$purchaseId}/{$newStatus}");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
    }
}
