<?php

namespace App\Repositories;

use App\Models\New;
use App\Repositories\BaseRepository;

/**
 * Class NewRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:33 pm UTC
*/

class NewRepository extends BaseRepository
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
        return New::class;
    }
}
