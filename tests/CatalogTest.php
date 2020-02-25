<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CatalogTest extends TestCase
{

    public function testList()
    {
        $this->get('/api/v1/catalog');

        $this->assertEquals(
            1,
            $this->response->getContent()
        );
    }
}
