<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{

    public function testList()
    {
        $this->post('/api/v1/cart/add', [
            'product_id' => 1,
            'count' => 1
        ]);

        dd($this->response->getContent());
    }
}
