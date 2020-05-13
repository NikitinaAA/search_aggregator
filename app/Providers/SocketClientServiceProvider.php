<?php

namespace App\Providers;

use App\Services\SocketClient\SocketClientInterface;
use App\Services\SocketClient\SocketClientService;
use Illuminate\Support\ServiceProvider;

class SocketClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SocketClientInterface::class,
            SocketClientService::class
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
