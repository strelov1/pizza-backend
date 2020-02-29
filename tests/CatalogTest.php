<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CatalogTest extends TestCase
{

    public function testList()
    {
        $this->get('/api/v1/catalog');

        $this->assertStringContainsString(
            'data',
            $this->response->getContent()
        );
    }
}
