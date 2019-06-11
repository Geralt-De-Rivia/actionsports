<?php

namespace App\Repositories;

use App\Models\KeyModel;
use App\Repositories\BaseRepository;

/**
 * Class KeyRepository
 * @package App\Repositories
 * @version June 11, 2019, 6:56 pm UTC
*/

class KeyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'label',
        'model',
        'reference'
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
        return KeyModel::class;
    }

    public function create($input)
    {
        $reference = null;
        foreach (KeyModel::$MODELS as $model){
            if($input['model'] === $model['id']){
                $input['reference'] = $model['reference'];
                break;
            }
        }
        return parent::create($input);
    }

    public function update($input, $id)
    {
        $reference = null;
        foreach (KeyModel::$MODELS as $model){
            if($input['model'] === $model['id']){
                $input['reference'] = $model['reference'];
                break;
            }
        }
        return parent::update($input, $id); // TODO: Change the autogenerated stub
    }
}
