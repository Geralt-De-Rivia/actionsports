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

class OrderByRelation implements CriteriaInterface
{
    private $relation, $order, $rule;

    //
    public function __construct($relation, $order, $rule)
    {
        $this->relation = $relation;
        $this->order = $order;
        $this->rule = $rule;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->with([$this->relation => function ($q) {
            $q->orderBy($this->order, $this->rule);
        }]);
        return $model;
    }
}