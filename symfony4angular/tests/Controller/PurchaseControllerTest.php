<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PurchaseControllerTest extends WebTestCase
{
    public function testCreatePurchase()
    {
        $client = static::createClient();

        $client->request('POST', '/create-purchase');

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 'Failed to create purchase');

        $this->assertJson($client->getResponse()->getContent(), 'Response is not a valid JSON');

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('message', $responseData, 'Response does not contain "message" key');
        $this->assertArrayHasKey('purchase_id', $responseData, 'Response does not contain "purchase_id" key');

        dump('Create Purchase Test Passed');
    }

    public function testListPurchases()
    {
        $client = static::createClient();

        $client->request('GET', '/list-purchases');

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 'Failed to list purchases');

        $this->assertJson($client->getResponse()->getContent(), 'Response is not a valid JSON');

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('purchases', $responseData, 'Response does not contain "purchases" key');

        dump('List Purchases Test Passed');
    }

    public function testUpdatePurchaseStatus()
    {
        $client = static::createClient();

        // Simulate creation of purchase to get the ID
        $client->request('POST', '/create-purchase');

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 'Failed to create purchase');

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('purchase_id', $responseData, 'Response does not contain "purchase_id" key');

        $purchaseId = $responseData['purchase_id'];

        $newStatus = 'cancelled';

        // Update the status of purchase that has been just created
        $client->request('PUT', "/update-purchase-status/{$purchaseId}/{$newStatus}");

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), 'Failed to update purchase status');

        $this->assertJson($client->getResponse()->getContent(), 'Response is not a valid JSON');

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('message', $responseData, 'Response does not contain "message" key');

        dump('Update Purchase Status Test Passed');
    }
}
