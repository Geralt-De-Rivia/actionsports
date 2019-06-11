<?php

namespace App\Repositories;

use App\Models\RoutineModel;
use App\Repositories\BaseRepository;

/**
 * Class RoutineRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:34 pm UTC
*/

class RoutineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'days',
        'difficulty'
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
        return RoutineModel::class;
    }
}
