<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CartTest extends TestCase
{
    use DatabaseTransactions;

    public function testAdd()
    {
        $this->post('/api/v1/token/issue');

        $tokenResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $tokenResponse['status']
        );

        $this->assertNotNull($tokenResponse['data']['token']);

        $productId = random_int(1, 30);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $addCartResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $addCartResponse['status']
        );

        $this->assertEquals(
            1,
            $addCartResponse['data']['count']
        );

        $this->assertEquals($productId, $addCartResponse['data']['products'][0]['product_id']);


        $this->get('/api/v1/cart/count', ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $countCartResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(1, $countCartResponse['data']['count']);
    }

    public function testUpdate()
    {
        $this->post('/api/v1/token/issue');

        $tokenResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $tokenResponse['status']
        );

        $this->assertNotNull($tokenResponse['data']['token']);

        $productId = random_int(1, 30);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $addCartResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $addCartResponse['status']
        );

        $this->assertEquals(
            1,
            $addCartResponse['data']['count']
        );

        $this->assertEquals($productId, $addCartResponse['data']['products'][0]['product_id']);


        $updateCount = random_int(1, 5);

        $this->post('/api/v1/cart/update', [
            'product_id' => $productId,
            'count' => $updateCount
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $updateCartResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals($updateCount, $updateCartResponse['data']['products'][0]['count']);

        $this->get('/api/v1/cart/count', ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $countCartResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals($updateCount, $countCartResponse['data']['count']);
    }

    public function testMultiAdd()
    {
        $this->post('/api/v1/token/issue');

        $tokenResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $tokenResponse['status']
        );

        $this->assertNotNull($tokenResponse['data']['token']);

        $productId = random_int(1, 30);
        $productId2 = random_int(1, 30);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId2,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId2,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $addCartResponseLast = json_decode($this->response->getContent(), true);

        $this->assertEquals(3, $addCartResponseLast['data']['count']);
    }

    public function testMultiUpdate()
    {
        $this->post('/api/v1/token/issue');

        $tokenResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $tokenResponse['status']
        );

        $this->assertNotNull($tokenResponse['data']['token']);

        $productId = random_int(1, 30);
        $productId2 = random_int(1, 30);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId2,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $updateCount = random_int(1, 5);

        $this->post('/api/v1/cart/update', [
            'product_id' => $productId,
            'count' => $updateCount
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $updateCartResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals($updateCount + 1, $updateCartResponse['data']['count']);

        $this->get('/api/v1/cart/count', ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);
        $countCartResponse = json_decode($this->response->getContent(), true);
        $this->assertEquals($updateCount + 1, $countCartResponse['data']['count']);
    }
}
