<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ClientRepository extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repositories\Client\ClientRepositoryInterface';
    }
}
