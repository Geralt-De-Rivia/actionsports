<?php

namespace App\Repositories;

use App\Models\ClientModel;
use App\Repositories\BaseRepository;

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
}
