<?php

namespace App\Repositories;

use App\Models\ClassTypeModel;
use App\Repositories\BaseRepository;

/**
 * Class ClassTypeRepository
 * @package App\Repositories
 * @version June 10, 2019, 11:20 pm UTC
*/

class ClassTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return ClassTypeModel::class;
    }
}
