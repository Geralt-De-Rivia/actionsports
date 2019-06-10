<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\New;
use App\Repositories\NewRepository;

trait MakeNewTrait
{
    /**
     * Create fake instance of New and save it in database
     *
     * @param array $newFields
     * @return New
     */
    public function makeNew($newFields = [])
    {
        /** @var NewRepository $newRepo */
        $newRepo = \App::make(NewRepository::class);
        $theme = $this->fakeNewData($newFields);
        return $newRepo->create($theme);
    }

    /**
     * Get fake instance of New
     *
     * @param array $newFields
     * @return New
     */
    public function fakeNew($newFields = [])
    {
        return new New($this->fakeNewData($newFields));
    }

    /**
     * Get fake data of New
     *
     * @param array $newFields
     * @return array
     */
    public function fakeNewData($newFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $newFields);
    }
}
