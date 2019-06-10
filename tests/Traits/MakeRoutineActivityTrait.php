<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\RoutineActivityModel;
use App\Repositories\RoutineActivityRepository;

trait MakeRoutineActivityTrait
{
    /**
     * Create fake instance of RoutineActivity and save it in database
     *
     * @param array $routineActivityFields
     * @return RoutineActivityModel
     */
    public function makeRoutineActivity($routineActivityFields = [])
    {
        /** @var RoutineActivityRepository $routineActivityRepo */
        $routineActivityRepo = \App::make(RoutineActivityRepository::class);
        $theme = $this->fakeRoutineActivityData($routineActivityFields);
        return $routineActivityRepo->create($theme);
    }

    /**
     * Get fake instance of RoutineActivity
     *
     * @param array $routineActivityFields
     * @return RoutineActivityModel
     */
    public function fakeRoutineActivity($routineActivityFields = [])
    {
        return new RoutineActivityModel($this->fakeRoutineActivityData($routineActivityFields));
    }

    /**
     * Get fake data of RoutineActivity
     *
     * @param array $routineActivityFields
     * @return array
     */
    public function fakeRoutineActivityData($routineActivityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'routine_id' => $fake->word,
            'activity_id' => $fake->word,
            'day' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $routineActivityFields);
    }
}
