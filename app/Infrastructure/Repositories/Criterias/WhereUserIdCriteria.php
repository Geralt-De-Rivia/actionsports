<?php namespace App\Infrastructure\Repositories\Criterias;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WhereUserIdCriteria implements CriteriaInterface
{
    private $userId;

    //
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', $this->userId);
        return $model;
    }
}