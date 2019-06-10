<?php namespace Tests\Repositories;

use App\Models\New;
use App\Repositories\NewRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeNewTrait;
use Tests\ApiTestTrait;

class NewRepositoryTest extends TestCase
{
    use MakeNewTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var NewRepository
     */
    protected $newRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->newRepo = \App::make(NewRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_new()
    {
        $new = $this->fakeNewData();
        $createdNew = $this->newRepo->create($new);
        $createdNew = $createdNew->toArray();
        $this->assertArrayHasKey('id', $createdNew);
        $this->assertNotNull($createdNew['id'], 'Created New must have id specified');
        $this->assertNotNull(New::find($createdNew['id']), 'New with given id must be in DB');
        $this->assertModelData($new, $createdNew);
    }

    /**
     * @test read
     */
    public function test_read_new()
    {
        $new = $this->makeNew();
        $dbNew = $this->newRepo->find($new->id);
        $dbNew = $dbNew->toArray();
        $this->assertModelData($new->toArray(), $dbNew);
    }

    /**
     * @test update
     */
    public function test_update_new()
    {
        $new = $this->makeNew();
        $fakeNew = $this->fakeNewData();
        $updatedNew = $this->newRepo->update($fakeNew, $new->id);
        $this->assertModelData($fakeNew, $updatedNew->toArray());
        $dbNew = $this->newRepo->find($new->id);
        $this->assertModelData($fakeNew, $dbNew->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_new()
    {
        $new = $this->makeNew();
        $resp = $this->newRepo->delete($new->id);
        $this->assertTrue($resp);
        $this->assertNull(New::find($new->id), 'New should not exist in DB');
    }
}
