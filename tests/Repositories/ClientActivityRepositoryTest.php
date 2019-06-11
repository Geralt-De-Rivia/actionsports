<?php namespace Tests\Repositories;

use App\Models\ClientActivityModel;
use App\Repositories\ClientActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClientActivityTrait;
use Tests\ApiTestTrait;

class ClientActivityRepositoryTest extends TestCase
{
    use MakeClientActivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClientActivityRepository
     */
    protected $clientActivityRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clientActivityRepo = \App::make(ClientActivityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_client_activity()
    {
        $clientActivity = $this->fakeClientActivityData();
        $createdClientActivity = $this->clientActivityRepo->create($clientActivity);
        $createdClientActivity = $createdClientActivity->toArray();
        $this->assertArrayHasKey('id', $createdClientActivity);
        $this->assertNotNull($createdClientActivity['id'], 'Created ClientActivity must have id specified');
        $this->assertNotNull(ClientActivityModel::find($createdClientActivity['id']), 'ClientActivity with given id must be in DB');
        $this->assertModelData($clientActivity, $createdClientActivity);
    }

    /**
     * @test read
     */
    public function test_read_client_activity()
    {
        $clientActivity = $this->makeClientActivity();
        $dbClientActivity = $this->clientActivityRepo->find($clientActivity->id);
        $dbClientActivity = $dbClientActivity->toArray();
        $this->assertModelData($clientActivity->toArray(), $dbClientActivity);
    }

    /**
     * @test update
     */
    public function test_update_client_activity()
    {
        $clientActivity = $this->makeClientActivity();
        $fakeClientActivity = $this->fakeClientActivityData();
        $updatedClientActivity = $this->clientActivityRepo->update($fakeClientActivity, $clientActivity->id);
        $this->assertModelData($fakeClientActivity, $updatedClientActivity->toArray());
        $dbClientActivity = $this->clientActivityRepo->find($clientActivity->id);
        $this->assertModelData($fakeClientActivity, $dbClientActivity->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_client_activity()
    {
        $clientActivity = $this->makeClientActivity();
        $resp = $this->clientActivityRepo->delete($clientActivity->id);
        $this->assertTrue($resp);
        $this->assertNull(ClientActivityModel::find($clientActivity->id), 'ClientActivity should not exist in DB');
    }
}
