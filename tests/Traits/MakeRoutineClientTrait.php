<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\RoutineClientModel;
use App\Repositories\RoutineClientRepository;

trait MakeRoutineClientTrait
{
    /**
     * Create fake instance of RoutineClientModel and save it in database
     *
     * @param array $routineClientFields
     * @return RoutineClientModel
     */
    public function makeRoutineClient($routineClientFields = [])
    {
        /** @var RoutineClientRepository $routineClientRepo */
        $routineClientRepo = \App::make(RoutineClientRepository::class);
        $theme = $this->fakeRoutineClientData($routineClientFields);
        return $routineClientRepo->create($theme);
    }

    /**
     * Get fake instance of RoutineClientModel
     *
     * @param array $routineClientFields
     * @return RoutineClientModel
     */
    public function fakeRoutineClient($routineClientFields = [])
    {
        return new RoutineClientModel($this->fakeRoutineClientData($routineClientFields));
    }

    /**
     * Get fake data of RoutineClientModel
     *
     * @param array $routineClientFields
     * @return array
     */
    public function fakeRoutineClientData($routineClientFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'routine_id' => $fake->word,
            'user_id' => $fake->word,
            'client_id' => $fake->word,
            'start_at' => $fake->word,
            'end_at' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $routineClientFields);
    }
}
