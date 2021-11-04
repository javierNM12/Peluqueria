<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductoController;

class alarmas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $productos = new ProductoController();
        $alarmas = $productos->getAlarmas();
        Session::flash('alarmas', $alarmas);

        return $next($request);
    }
}
