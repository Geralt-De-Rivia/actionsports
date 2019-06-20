<?php

namespace App\Repositories;

use App\Models\ClientModel;

/**
 * Class ClientRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:33 pm UTC
 */
class ClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'dni',
        'name',
        'last_name',
        'phone_number',
        'email',
        'code',
        'image_url',
        'membership_number',
        'client_status_id',
        'birth_date',
        'email_verified_at',
        'password'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ClientModel::class;
    }

    public function create($input)
    {
        $input['client_status_id'] = 1;
        $input['membership_number'] = $input['dni'];
        return parent::create($input);
    }

    public function login($memberShipNumber, $code)
    {
        $client = ClientModel::where('membership_number', '=', $memberShipNumber)
            ->where('code', '=', $code)
            ->get()
            ->first();

        if (empty($client)) {
            throw new \Exception("El cliente no existe");
        }

        if ($client->client_status_id == 1) {
            throw new \Exception("El cliente se encuentra en estado preinscrito");
        }

        if ($client->client_status_id == 3) {
            throw new \Exception("El cliente se encuentra suspendido");
        }

        return $client;
    }
}
