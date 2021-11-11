<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Clientes;
use Carbon\Carbon;
use DB;

class PeluqueriaController extends Controller
{
    // cargar en index principal
    public function inicio()
    {
        //DB::enableQueryLog();
        $mytime = Carbon::now();
        $citas = Citas::orderBy('fecha_hora', 'asc')->where('fecha_hora', '>=', $mytime->startOfDay()->toDateTimeString())->where('fecha_hora', '<=', $mytime->endOfDay()->toDateTimeString())->where('finalizado', '!=', '1')->get();

        $clientes = Clientes::get();
        //dd(DB::getQueryLog());
        return view("inicio", compact(['citas', 'clientes']));
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
