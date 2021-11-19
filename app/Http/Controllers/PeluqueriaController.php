<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Clientes;
use App\Models\Servicios;
use Carbon\Carbon;
use DB;

class PeluqueriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('alarmas');
    }
    
    // cargar en index principal
    public function inicio()
    {
        $servicios = Servicios::get();

        //DB::enableQueryLog();
        $mytime = Carbon::now();
        $citas = Citas::orderBy('fecha_hora_i', 'asc')->where('fecha_hora_i', '>=', $mytime->startOfDay()->toDateTimeString())->where('fecha_hora_f', '<=', $mytime->endOfDay()->toDateTimeString())->where('finalizado', '=', '0')->get();

        $clientes = Clientes::get();
        //dd(DB::getQueryLog());
        return view("inicio", compact(['citas', 'clientes', 'servicios']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
