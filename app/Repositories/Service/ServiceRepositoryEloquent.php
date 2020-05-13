<?php

namespace App\Repositories\Service;

use App\Repositories\BaseRepositoryEloquent;
use App\Service;

class ServiceRepositoryEloquent extends BaseRepositoryEloquent implements ServiceRepositoryInterface
{
    /**
     * @var Service
     */
    protected $model;

    /**
     * ServiceRepositoryEloquent constructor.
     * @param Service $model
     */
    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getActiveItems()
    {
        return $this->queryActive()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getMainItem()
    {
        return $this->queryActive()->where('is_main', true)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSecondaryItems()
    {
        return $this->queryActive()->where('is_main', false)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function queryActive()
    {
        return $this->query()->where('is_active', true);
    }
}
