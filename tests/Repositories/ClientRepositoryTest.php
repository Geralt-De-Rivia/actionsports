<?php namespace Tests\Repositories;

use App\Models\ClientModel;
use App\Repositories\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClientTrait;
use Tests\ApiTestTrait;

class ClientRepositoryTest extends TestCase
{
    use MakeClientTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClientRepository
     */
    protected $clientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clientRepo = \App::make(ClientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_client()
    {
        $client = $this->fakeClientData();
        $createdClient = $this->clientRepo->create($client);
        $createdClient = $createdClient->toArray();
        $this->assertArrayHasKey('id', $createdClient);
        $this->assertNotNull($createdClient['id'], 'Created Client must have id specified');
        $this->assertNotNull(ClientModel::find($createdClient['id']), 'Client with given id must be in DB');
        $this->assertModelData($client, $createdClient);
    }

    /**
     * @test read
     */
    public function test_read_client()
    {
        $client = $this->makeClient();
        $dbClient = $this->clientRepo->find($client->id);
        $dbClient = $dbClient->toArray();
        $this->assertModelData($client->toArray(), $dbClient);
    }

    /**
     * @test update
     */
    public function test_update_client()
    {
        $client = $this->makeClient();
        $fakeClient = $this->fakeClientData();
        $updatedClient = $this->clientRepo->update($fakeClient, $client->id);
        $this->assertModelData($fakeClient, $updatedClient->toArray());
        $dbClient = $this->clientRepo->find($client->id);
        $this->assertModelData($fakeClient, $dbClient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_client()
    {
        $client = $this->makeClient();
        $resp = $this->clientRepo->delete($client->id);
        $this->assertTrue($resp);
        $this->assertNull(ClientModel::find($client->id), 'Client should not exist in DB');
    }
}
