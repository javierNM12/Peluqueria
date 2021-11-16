<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Clientes;
use App\Models\Servicios;
use Carbon\Carbon;
use DB;

class CitasController extends Controller
{
    public function finalizar(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $cita = Citas::find($request->id);
        $cita->finalizado = 1;
        $cita->save();
        return response()->json(['success' => $request->id]);
    }

    public function eliminar(Request $request)
    {
        $cita = Citas::find($request->id);
        $cita->servicios()->detach();
        $cita->delete();
        return response()->json(['success' => $request->id]);
    }

    public function listar()
    {
        // DB::enableQueryLog();
        $mytime = Carbon::now();
        $citas = Citas::orderBy('fecha_hora', 'asc')->where('fecha_hora', '>=', $mytime->startOfDay()->toDateTimeString())->where('fecha_hora', '<=', $mytime->endOfDay()->toDateTimeString())->where('finalizado', '!=', '1')->get();
        // dd(DB::getQueryLog());
        return response()->json($citas);
    }

    public function horas(Request $request)
    {
        // DB::enableQueryLog();
        $request->fecha;
        // ************************SELECT CONCAT(fecha_hora_i, fecha_hora_f) AS WHOLENAME FROM `citas` WHERE fecha_hora_i LIKE '%2021/11/16%' OR fecha_hora_f LIKE '%2021/11/16%'; 
        $citas = Citas::select('fecha_hora_i', 'fecha_hora_f')->where('fecha_hora_i', 'LIKE', '%' . $request->fecha . '%')->where('fecha_hora_f', 'LIKE', '%' . $request->fecha . '%')->get();
        // dd(DB::getQueryLog());
        return response()->json($citas);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['citas'] = Citas::orderBy('id', 'desc')->paginate(5);
        return view('citas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicios::get();
        $clientes = Clientes::get();

        return view('citas.create', compact(['servicios', 'clientes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
        ]);

        // DB::enableQueryLog();
        $cliente = Clientes::find($request->clientes_id)->first();
        // dd(DB::getQueryLog());
        $citas = new Citas;


        //dia y hora

        $fecha_hora_i = $request->dia . " " . $request->get('hora')[0] . ":00";
        $fecha_hora_f = $request->dia . " " . $request->get('hora')[count($request->get('hora')) - 1] . ":00";

        $citas->fecha_hora_i = $fecha_hora_i;
        $citas->fecha_hora_f = $fecha_hora_f;

        $citas->descripcion = $request->descripcion;
        $citas->finalizado = 0; //-> si añadimos una cita siempre estará pendiente
        $citas->clientes_id = $cliente->id;

        $citas->save();
        $citas->clientes()->associate($cliente);

        for ($i = 0; $i < count($request->get('servicios_id')); $i++) {
            $new[$i] = array('servicios_id' => $request->get('servicios_id')[$i]);
        }

        $citas->servicios()->sync($new);
        return redirect()->route('citas.index')
            ->with('success', 'citas has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $citas = Citas::find($id)->first();
        return view('citas.show', compact('citas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $citas = Citas::selectRaw('*')->where('id', 'like', $id)->first();
        return view('citas.edit', compact('citas'));
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
        $request->validate([
            'fecha_hora' => 'required',
            'descripcion' => 'required',
        ]);
        $cita = Citas::find($id);
        $cita->fecha_hora = $request->fecha_hora;
        $cita->descripcion = $request->descripcion;
        $cita->clientes_id = $request->clientes_id;

        $cita->save();

        return redirect()->route('citas.index')
            ->with('success', 'Cita Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Citas::find($id);
        $cita->servicios()->detach();
        $cita->delete();
        return redirect()->route('citas.index')
            ->with('success', 'Client has been deleted successfully');
    }
}
