<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\RoutineModel;
use App\Repositories\RoutineRepository;

trait MakeRoutineTrait
{
    /**
     * Create fake instance of RoutineModel and save it in database
     *
     * @param array $routineFields
     * @return RoutineModel
     */
    public function makeRoutine($routineFields = [])
    {
        /** @var RoutineRepository $routineRepo */
        $routineRepo = \App::make(RoutineRepository::class);
        $theme = $this->fakeRoutineData($routineFields);
        return $routineRepo->create($theme);
    }

    /**
     * Get fake instance of RoutineModel
     *
     * @param array $routineFields
     * @return RoutineModel
     */
    public function fakeRoutine($routineFields = [])
    {
        return new RoutineModel($this->fakeRoutineData($routineFields));
    }

    /**
     * Get fake data of RoutineModel
     *
     * @param array $routineFields
     * @return array
     */
    public function fakeRoutineData($routineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'days' => $fake->word,
            'difficulty' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $routineFields);
    }
}
