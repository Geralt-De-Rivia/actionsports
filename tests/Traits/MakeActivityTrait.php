<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ActivityModel;
use App\Repositories\ActivityRepository;

trait MakeActivityTrait
{
    /**
     * Create fake instance of Activity and save it in database
     *
     * @param array $activityFields
     * @return ActivityModel
     */
    public function makeActivity($activityFields = [])
    {
        /** @var ActivityRepository $activityRepo */
        $activityRepo = \App::make(ActivityRepository::class);
        $theme = $this->fakeActivityData($activityFields);
        return $activityRepo->create($theme);
    }

    /**
     * Get fake instance of Activity
     *
     * @param array $activityFields
     * @return ActivityModel
     */
    public function fakeActivity($activityFields = [])
    {
        return new ActivityModel($this->fakeActivityData($activityFields));
    }

    /**
     * Get fake data of Activity
     *
     * @param array $activityFields
     * @return array
     */
    public function fakeActivityData($activityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $activityFields);
    }
}
