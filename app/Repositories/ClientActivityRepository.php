<?php

namespace App\Repositories;

use App\Models\ClientActivityModel;
use App\Repositories\BaseRepository;

/**
 * Class ClientActivityRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:38 pm UTC
*/

class ClientActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'activity_id',
        'client_id'
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
        return ClientActivityModel::class;
    }
}
