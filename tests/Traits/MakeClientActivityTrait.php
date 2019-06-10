<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ClientActivityModel;
use App\Repositories\ClientActivityRepository;

trait MakeClientActivityTrait
{
    /**
     * Create fake instance of ClientActivity and save it in database
     *
     * @param array $clientActivityFields
     * @return ClientActivityModel
     */
    public function makeClientActivity($clientActivityFields = [])
    {
        /** @var ClientActivityRepository $clientActivityRepo */
        $clientActivityRepo = \App::make(ClientActivityRepository::class);
        $theme = $this->fakeClientActivityData($clientActivityFields);
        return $clientActivityRepo->create($theme);
    }

    /**
     * Get fake instance of ClientActivity
     *
     * @param array $clientActivityFields
     * @return ClientActivityModel
     */
    public function fakeClientActivity($clientActivityFields = [])
    {
        return new ClientActivityModel($this->fakeClientActivityData($clientActivityFields));
    }

    /**
     * Get fake data of ClientActivity
     *
     * @param array $clientActivityFields
     * @return array
     */
    public function fakeClientActivityData($clientActivityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'activity_id' => $fake->word,
            'client_id' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $clientActivityFields);
    }
}
