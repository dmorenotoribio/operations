<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Circuit\Facade\CircuitBreaker;

class OperationsController extends Controller
{
    const CIRCUITBREAKER_SUM = 'operations_sum';

    public function Sum(Request $request)
    {
        if (CircuitBreaker::isAvailable(self::CIRCUITBREAKER_SUM)) 
        {
            $a = $request->input('a');
            $b = $request->input('b');

            if($a==0 && $b==0)
            {
                CircuitBreaker::reportFailure(self::CIRCUITBREAKER_SUM);
                return [
                    'Code' => '400',
                    'Result' => 'Los importes no pueden ser cero.',
                ];
            } else 
            {
                CircuitBreaker::reportSuccess(self::CIRCUITBREAKER_SUM);
                return [
                    'Code' => '200',
                    'Result' => ($a + $b),
                ];
            }
        } else 
        {
            return [
                'Code' => '600',
                'Result' => 'El circuito esta temporalmente abierto.',
            ];
        }    
    }
}
