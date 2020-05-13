<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SearchRequestRepository extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repositories\SearchRequest\SearchRequestRepositoryInterface';
    }
}
