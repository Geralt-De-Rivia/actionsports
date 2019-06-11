<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ClassScheduleModel;
use App\Repositories\ClassScheduleRepository;

trait MakeClassScheduleTrait
{
    /**
     * Create fake instance of ClassSchedule and save it in database
     *
     * @param array $classScheduleFields
     * @return ClassScheduleModel
     */
    public function makeClassSchedule($classScheduleFields = [])
    {
        /** @var ClassScheduleRepository $classScheduleRepo */
        $classScheduleRepo = \App::make(ClassScheduleRepository::class);
        $theme = $this->fakeClassScheduleData($classScheduleFields);
        return $classScheduleRepo->create($theme);
    }

    /**
     * Get fake instance of ClassSchedule
     *
     * @param array $classScheduleFields
     * @return ClassScheduleModel
     */
    public function fakeClassSchedule($classScheduleFields = [])
    {
        return new ClassScheduleModel($this->fakeClassScheduleData($classScheduleFields));
    }

    /**
     * Get fake data of ClassSchedule
     *
     * @param array $classScheduleFields
     * @return array
     */
    public function fakeClassScheduleData($classScheduleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'class_id' => $fake->word,
            'user_id' => $fake->word,
            'quota_min' => $fake->randomDigitNotNull,
            'quota_max' => $fake->randomDigitNotNull,
            'start_at' => $fake->word,
            'end_at' => $fake->word,
            'status' => $fake->word,
            'recurrence' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $classScheduleFields);
    }
}
