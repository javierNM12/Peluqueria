<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;

class PinController extends Controller
{
    public function store(Request $request)
    {
        // config(['settings.PIN' => '0000']); -> para cambiar el PIN
        if ($request->pin === Config::get('settings.PIN')) {
            return redirect(Session::get('url'))->withCookie('access', 'pass', 1); // 1 minuto
        }

        return redirect(route('pin.create'));
    }
}