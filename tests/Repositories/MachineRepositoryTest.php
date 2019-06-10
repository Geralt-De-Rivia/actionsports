<?php namespace Tests\Repositories;

use App\Models\MachineModel;
use App\Repositories\MachineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMachineTrait;
use Tests\ApiTestTrait;

class MachineRepositoryTest extends TestCase
{
    use MakeMachineTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MachineRepository
     */
    protected $machineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->machineRepo = \App::make(MachineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_machine()
    {
        $machine = $this->fakeMachineData();
        $createdMachine = $this->machineRepo->create($machine);
        $createdMachine = $createdMachine->toArray();
        $this->assertArrayHasKey('id', $createdMachine);
        $this->assertNotNull($createdMachine['id'], 'Created MachineModel must have id specified');
        $this->assertNotNull(MachineModel::find($createdMachine['id']), 'MachineModel with given id must be in DB');
        $this->assertModelData($machine, $createdMachine);
    }

    /**
     * @test read
     */
    public function test_read_machine()
    {
        $machine = $this->makeMachine();
        $dbMachine = $this->machineRepo->find($machine->id);
        $dbMachine = $dbMachine->toArray();
        $this->assertModelData($machine->toArray(), $dbMachine);
    }

    /**
     * @test update
     */
    public function test_update_machine()
    {
        $machine = $this->makeMachine();
        $fakeMachine = $this->fakeMachineData();
        $updatedMachine = $this->machineRepo->update($fakeMachine, $machine->id);
        $this->assertModelData($fakeMachine, $updatedMachine->toArray());
        $dbMachine = $this->machineRepo->find($machine->id);
        $this->assertModelData($fakeMachine, $dbMachine->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_machine()
    {
        $machine = $this->makeMachine();
        $resp = $this->machineRepo->delete($machine->id);
        $this->assertTrue($resp);
        $this->assertNull(MachineModel::find($machine->id), 'MachineModel should not exist in DB');
    }
}
