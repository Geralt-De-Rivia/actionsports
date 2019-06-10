<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ClassTypeModel;
use App\Repositories\ClassTypeRepository;

trait MakeClassTypeTrait
{
    /**
     * Create fake instance of ClassType and save it in database
     *
     * @param array $classTypeFields
     * @return ClassTypeModel
     */
    public function makeClassType($classTypeFields = [])
    {
        /** @var ClassTypeRepository $classTypeRepo */
        $classTypeRepo = \App::make(ClassTypeRepository::class);
        $theme = $this->fakeClassTypeData($classTypeFields);
        return $classTypeRepo->create($theme);
    }

    /**
     * Get fake instance of ClassType
     *
     * @param array $classTypeFields
     * @return ClassTypeModel
     */
    public function fakeClassType($classTypeFields = [])
    {
        return new ClassTypeModel($this->fakeClassTypeData($classTypeFields));
    }

    /**
     * Get fake data of ClassType
     *
     * @param array $classTypeFields
     * @return array
     */
    public function fakeClassTypeData($classTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $classTypeFields);
    }
}
