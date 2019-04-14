<?php

namespace App\Circuit\Provider;

use Illuminate\Support\ServiceProvider;

class CircuitBreakerServiceProvider extends ServiceProvider
{   
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {        
        $this->app->bind("App\Circuit\Store\CircuitBreakerStoreInterface", "App\Circuit\Store\CacheCircuitBreakerStore");             
    }
}
