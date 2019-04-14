<?php

namespace App\Circuit\Facade;

use App\Circuit\Manager\CircuitBreakerManager;
use Illuminate\Support\Facades\Facade;

class CircuitBreaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CircuitBreakerManager::class;
    }
}
