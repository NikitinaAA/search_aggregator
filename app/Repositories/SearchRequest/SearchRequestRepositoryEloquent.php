<?php

namespace App\Repositories\SearchRequest;

use App\Repositories\BaseRepositoryEloquent;
use App\SearchRequest;

class SearchRequestRepositoryEloquent extends BaseRepositoryEloquent implements SearchRequestRepositoryInterface
{
    /**
     * @var SearchRequest
     */
    protected $model;

    /**
     * SearchRequestRepositoryEloquent constructor.
     * @param SearchRequest $model
     */
    public function __construct(SearchRequest $model)
    {
        $this->model = $model;
    }
}
