<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ServiceRepository extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repositories\Service\ServiceRepositoryInterface';
    }
}
