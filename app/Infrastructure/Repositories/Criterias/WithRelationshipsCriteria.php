<?php namespace App\Infrastructure\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WithRelationshipsCriteria implements CriteriaInterface
{
    private $arrayWith;

    //
    public function __construct($arrayWith)
    {

        $this->arrayWith = $arrayWith;
    }


    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->with($this->arrayWith);
        return $model;
    }
}