<?php

namespace App\Repositories;

use App\Models\ActivityModel;
use App\Repositories\BaseRepository;

/**
 * Class ActivityRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:30 pm UTC
*/

class ActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return ActivityModel::class;
    }
}
