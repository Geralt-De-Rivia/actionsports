<?php

namespace App\Repositories;

use App\Models\ClassModel;
use App\Repositories\BaseRepository;

/**
 * Class ClassRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:31 pm UTC
*/

class ClassRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'minutes',
        'status',
        'reservable',
        'class_type_id'
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
        return ClassModel::class;
    }
}
