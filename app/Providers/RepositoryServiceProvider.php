<?php

namespace App\Providers;

use App\Repositories\Client\ClientRepositoryEloquent;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\SearchRequest\SearchRequestRepositoryEloquent;
use App\Repositories\SearchRequest\SearchRequestRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryEloquent;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepositoryEloquent::class
        );

        $this->app->bind(
            SearchRequestRepositoryInterface::class,
            SearchRequestRepositoryEloquent::class
        );

        $this->app->bindIf(
            ServiceRepositoryInterface::class,
            ServiceRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
