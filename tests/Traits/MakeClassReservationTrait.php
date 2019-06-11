<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ClassReservationModel;
use App\Repositories\ClassReservationRepository;

trait MakeClassReservationTrait
{
    /**
     * Create fake instance of ClassReservation and save it in database
     *
     * @param array $classReservationFields
     * @return ClassReservationModel
     */
    public function makeClassReservation($classReservationFields = [])
    {
        /** @var ClassReservationRepository $classReservationRepo */
        $classReservationRepo = \App::make(ClassReservationRepository::class);
        $theme = $this->fakeClassReservationData($classReservationFields);
        return $classReservationRepo->create($theme);
    }

    /**
     * Get fake instance of ClassReservation
     *
     * @param array $classReservationFields
     * @return ClassReservationModel
     */
    public function fakeClassReservation($classReservationFields = [])
    {
        return new ClassReservationModel($this->fakeClassReservationData($classReservationFields));
    }

    /**
     * Get fake data of ClassReservation
     *
     * @param array $classReservationFields
     * @return array
     */
    public function fakeClassReservationData($classReservationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'client_id' => $fake->word,
            'class_schedule_id' => $fake->word,
            'day' => $fake->word,
            'start_time' => $fake->word,
            'date' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $classReservationFields);
    }
}
