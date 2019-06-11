<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ClientModel;
use App\Repositories\ClientRepository;

trait MakeClientTrait
{
    /**
     * Create fake instance of Client and save it in database
     *
     * @param array $clientFields
     * @return ClientModel
     */
    public function makeClient($clientFields = [])
    {
        /** @var ClientRepository $clientRepo */
        $clientRepo = \App::make(ClientRepository::class);
        $theme = $this->fakeClientData($clientFields);
        return $clientRepo->create($theme);
    }

    /**
     * Get fake instance of Client
     *
     * @param array $clientFields
     * @return ClientModel
     */
    public function fakeClient($clientFields = [])
    {
        return new ClientModel($this->fakeClientData($clientFields));
    }

    /**
     * Get fake data of Client
     *
     * @param array $clientFields
     * @return array
     */
    public function fakeClientData($clientFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'dni' => $fake->word,
            'name' => $fake->word,
            'last_name' => $fake->word,
            'phone_number' => $fake->word,
            'email' => $fake->word,
            'code' => $fake->word,
            'image_url' => $fake->word,
            'membership_number' => $fake->word,
            'client_status_id' => $fake->word,
            'birth_date' => $fake->word,
            'email_verified_at' => $fake->date('Y-m-d H:i:s'),
            'password' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $clientFields);
    }
}
