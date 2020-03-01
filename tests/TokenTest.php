<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TokenTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->post('/api/v1/token/issue');

        $response = json_decode($this->response->getContent(), true);

        $this->assertEquals(
            1,
            $response['status']
        );

        $this->assertNotNull($response['data']['token']);
    }
}
