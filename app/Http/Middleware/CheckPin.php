<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckPin
{
    public function handle($request, Closure $next)
    {
        if ($request->cookie('access') === 'pass') {
            return $next($request);
        }

        session(['url' => $request->url()]); // almaceno la url a la que se quería acceder
        return redirect(route('pin.create'));
    }
}