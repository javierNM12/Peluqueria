<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Clientes;
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
        return view('citas.create');
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
            'fecha_hora' => 'required',
            'descripcion' => 'required',
        ]);
        // DB::enableQueryLog();
        $cliente = Clientes::find($request->clientes_id)->first();
        // dd(DB::getQueryLog());
        $citas = new Citas;
        $citas->fecha_hora = $request->fecha_hora;
        $citas->descripcion = $request->descripcion;
        $citas->finalizado = 0; //-> si añadimos una cita siempre estará pendiente
        $citas->clientes_id = $cliente->id;

        $citas->save();
        $citas->clientes()->associate($cliente);

        $data = [
            $request->servicios_id,
        ];
        $citas->servicios()->sync($data);

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
