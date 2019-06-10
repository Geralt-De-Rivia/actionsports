<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Class;
use App\Repositories\ClassRepository;

trait MakeClassTrait
{
    /**
     * Create fake instance of Class and save it in database
     *
     * @param array $classFields
     * @return Class
     */
    public function makeClass($classFields = [])
    {
        /** @var ClassRepository $classRepo */
        $classRepo = \App::make(ClassRepository::class);
        $theme = $this->fakeClassData($classFields);
        return $classRepo->create($theme);
    }

    /**
     * Get fake instance of Class
     *
     * @param array $classFields
     * @return Class
     */
    public function fakeClass($classFields = [])
    {
        return new Class($this->fakeClassData($classFields));
    }

    /**
     * Get fake data of Class
     *
     * @param array $classFields
     * @return array
     */
    public function fakeClassData($classFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'minutes' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'reservable' => $fake->word,
            'class_type_id' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $classFields);
    }
}
