<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/04/16
 * Time: 03:37 PM
 */

namespace App\Infrastructure\Repositories\Criterias;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WhereHasCriteria implements  CriteriaInterface
{
    private $relation, $field, $value, $operator;

    //
    public function __construct($relation, $field, $value = null, $operator = "=")
    {
        $this->relation = $relation;
        $this->field = $field;
        $this->value = $value;
        $this->operator = $operator;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->with($this->relation)->whereHas($this->relation,function($q){
            $q->where($this->field, $this->operator, $this->value);
        });
        return $model;
    }
}