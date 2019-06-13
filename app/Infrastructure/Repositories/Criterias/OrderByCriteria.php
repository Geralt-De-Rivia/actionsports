<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 25/03/16
 * Time: 11:18 AM
 */

namespace App\Infrastructure\Repositories\Criterias;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrderByCriteria implements CriteriaInterface
{
    private $field, $operator;

    //
    public function __construct($field, $operator = "desc")
    {
        $this->field = $field;
        $this->operator = $operator;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->orderBy($this->field, $this->operator);
        return $model;
    }
}