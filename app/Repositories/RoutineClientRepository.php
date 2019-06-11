<?php

namespace App\Repositories;

use App\Models\RoutineClientModel;
use App\Repositories\BaseRepository;

/**
 * Class RoutineClientRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:38 pm UTC
*/

class RoutineClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'routine_id',
        'user_id',
        'client_id',
        'start_at',
        'end_at',
        'status'
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
        return RoutineClientModel::class;
    }
}
