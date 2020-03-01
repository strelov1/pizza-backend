<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->post('/api/v1/token/issue');

        $tokenResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $tokenResponse['status']
        );

        $productId = random_int(1, 30);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $this->post('/api/v1/order/create', [
            'name' => "Test",
            'phone' => "823423423",
            'street' => "Test",
            'house' => "",
            'flat' => "1",
            'flour' => "1",
            'delivery_time' => "2020-01-01T11:48:46.000Z",
            'comment' => "Faster Please",
            'payment_way' => "Credit Card",
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $createOrderResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $createOrderResponse['status']
        );

        $orderId = $createOrderResponse['data']['order_id'];

        $this->seeInDatabase(\App\Models\Order::tableName(), ['id' => $orderId]);
    }

    public function testLasteOrder()
    {
        $this->post('/api/v1/token/issue');

        $tokenResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $tokenResponse['status']
        );

        $productId = random_int(1, 30);

        $this->post('/api/v1/cart/add', [
            'product_id' => $productId,
            'count' => 1
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $name = 'Test';
        $phone = 'Test3434';

        $this->post('/api/v1/order/create', [
            'name' => $name,
            'phone' => $phone,
            'street' => "Test",
            'house' => "",
            'flat' => "1",
            'flour' => "1",
            'delivery_time' => "2020-01-01T11:48:46.000Z",
            'comment' => "Faster Please",
            'payment_way' => "Credit Card",
        ], ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $createOrderResponse = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $createOrderResponse['status']
        );

        $this->get('/api/v1/order/last', ['Authorization' => 'Bearer ' . $tokenResponse['data']['token']]);

        $lastOrder = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $lastOrder['status']
        );

        $this->assertEquals(
            $name,
            $lastOrder['data']['name']
        );

        $this->assertEquals(
            $phone,
            $lastOrder['data']['phone']
        );

    }
}
