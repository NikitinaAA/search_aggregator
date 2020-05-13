<?php

namespace App\Providers;

use App\Observers\SearchRequestObserver;
use App\SearchRequest;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        SearchRequest::observe(SearchRequestObserver::class);
    }
}
