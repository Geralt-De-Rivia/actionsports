<?php namespace Tests\Repositories;

use App\Models\ActivityModel;
use App\Repositories\ActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeActivityTrait;
use Tests\ApiTestTrait;

class ActivityRepositoryTest extends TestCase
{
    use MakeActivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActivityRepository
     */
    protected $activityRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->activityRepo = \App::make(ActivityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_activity()
    {
        $activity = $this->fakeActivityData();
        $createdActivity = $this->activityRepo->create($activity);
        $createdActivity = $createdActivity->toArray();
        $this->assertArrayHasKey('id', $createdActivity);
        $this->assertNotNull($createdActivity['id'], 'Created Activity must have id specified');
        $this->assertNotNull(ActivityModel::find($createdActivity['id']), 'Activity with given id must be in DB');
        $this->assertModelData($activity, $createdActivity);
    }

    /**
     * @test read
     */
    public function test_read_activity()
    {
        $activity = $this->makeActivity();
        $dbActivity = $this->activityRepo->find($activity->id);
        $dbActivity = $dbActivity->toArray();
        $this->assertModelData($activity->toArray(), $dbActivity);
    }

    /**
     * @test update
     */
    public function test_update_activity()
    {
        $activity = $this->makeActivity();
        $fakeActivity = $this->fakeActivityData();
        $updatedActivity = $this->activityRepo->update($fakeActivity, $activity->id);
        $this->assertModelData($fakeActivity, $updatedActivity->toArray());
        $dbActivity = $this->activityRepo->find($activity->id);
        $this->assertModelData($fakeActivity, $dbActivity->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_activity()
    {
        $activity = $this->makeActivity();
        $resp = $this->activityRepo->delete($activity->id);
        $this->assertTrue($resp);
        $this->assertNull(ActivityModel::find($activity->id), 'Activity should not exist in DB');
    }
}
