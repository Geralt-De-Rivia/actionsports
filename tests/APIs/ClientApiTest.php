<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClientTrait;
use Tests\ApiTestTrait;

class ClientApiTest extends TestCase
{
    use MakeClientTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_client()
    {
        $client = $this->fakeClientData();
        $this->response = $this->json('POST', '/api/clients', $client);

        $this->assertApiResponse($client);
    }

    /**
     * @test
     */
    public function test_read_client()
    {
        $client = $this->makeClient();
        $this->response = $this->json('GET', '/api/clients/'.$client->id);

        $this->assertApiResponse($client->toArray());
    }

    /**
     * @test
     */
    public function test_update_client()
    {
        $client = $this->makeClient();
        $editedClient = $this->fakeClientData();

        $this->response = $this->json('PUT', '/api/clients/'.$client->id, $editedClient);

        $this->assertApiResponse($editedClient);
    }

    /**
     * @test
     */
    public function test_delete_client()
    {
        $client = $this->makeClient();
        $this->response = $this->json('DELETE', '/api/clients/'.$client->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/clients/'.$client->id);

        $this->response->assertStatus(404);
    }
}
