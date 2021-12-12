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
    public function __construct()
    {
        $this->middleware('alarmas');
    }

    public function citascantidadclientesid(Request $request)
    {
        $data = Citas::selectRaw('count(*) as cantidad')->whereRaw('clientes_id = "' . $request->id . '"')->get();

        return response()->json($data);
    }

    public function historicocitas(Request $request)
    {
        $data['citas'] = Citas::selectRaw('*')->whereRaw('fecha_hora_i >= "' . $request->fechai . ' 00:00:00"')->whereRaw('fecha_hora_f <= "' . $request->fechaf . ' 23:59:59"')->get();

        foreach ($data['citas'] as $key => $value) {
            $data['clientes'][$value->id] = Citas::find($value->id)->clientes()->get();
        }

        foreach ($data['citas'] as $key => $value) {
            $data['servicios'][$value->id] = Citas::find($value->id)->servicios()->get();
        }

        return response()->json($data);
    }

    public function formhistorico()
    {
        return view('citas.formhistorico');
    }

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

    public function fincita($id)
    {
        $cita = Citas::find($id);
        $cita->finalizado = 1;
        $cita->save();
        return redirect()->route('citas.index')
            ->with('success', 'Cita finalizada.');
    }

    public function canelcita($id)
    {
        $cita = Citas::find($id);
        $cita->finalizado = 2;
        $cita->save();
        return redirect()->route('citas.index')
            ->with('success', 'Cita cancelada.');
    }

    public function cancelar(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $cita = Citas::find($request->id);
        $cita->finalizado = 2;
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
        $datos['citas'] = Citas::orderBy('fecha_hora_i', 'asc')->where('fecha_hora_i', '>=', $mytime->startOfDay()->toDateTimeString())->where('fecha_hora_f', '<=', $mytime->endOfDay()->toDateTimeString())->where('finalizado', '==', '0')->get();

        $datos['clientes'] = Clientes::get();
        // dd(DB::getQueryLog());
        return response()->json($datos);
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
        $data['citas'] = Citas::orderBy('id', 'desc')->simplePaginate(5);
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
        $rules = [
            'descripcion' => 'required|string',
        ];

        $customMessages = [
            'required' => 'El campo :attribute no se puede dejar en blanco.',
            'string' => 'El campo :attribute debe ser texto.'
        ];

        $this->validate($request, $rules, $customMessages);

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
            ->with('success', 'Cita guardada correctamente.');
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
        $clientes = $citas->clientes()->get();
        $clientesall = Clientes::all();
        $servicios = $citas->servicios()->get();
        $serviciosall = Servicios::all();
        return view('citas.edit', compact(['citas', 'clientes', 'clientesall', 'servicios', 'serviciosall']));
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
        $rules = [
            'fecha_hora_i' => 'required|date_format:Y-m-d H:i:s',
            'fecha_hora_f' => 'required|date_format:Y-m-d H:i:s',
            'descripcion' => 'required|string',
        ];

        $customMessages = [
            'required' => 'El campo :attribute no se puede dejar en blanco.',
            'string' => 'El campo :attribute debe ser texto.',
            'date' => 'El campo :attribute no es un campo de fecha correcto.',
        ];

        $this->validate($request, $rules, $customMessages);

        $cita = Citas::find($id);
        $cita->fecha_hora_i = $request->fecha_hora_i;
        $cita->fecha_hora_f = $request->fecha_hora_f;

        $cliente = Clientes::find($request->clientes_id)->first();

        $cita->descripcion = $request->descripcion;
        $cita->clientes_id = $cliente->id;

        $cita->save();
        $cita->clientes()->associate($cliente);

        for ($i = 0; $i < count($request->get('servicios_id')); $i++) {
            $new[$i] = array('servicios_id' => $request->get('servicios_id')[$i]);
        }
        $cita->servicios()->sync($new);

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada correctamente');
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
            ->with('success', 'Cita eliminada correctamente');
    }
}
