<?php

namespace App\Http\Middleware;

use Closure;

class Cors {
    
    public function handle($request, Closure $next) {
        
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application', 'ip');
        $response->headers->set('Accept', 'application/json');
        return $response; 
    }
}