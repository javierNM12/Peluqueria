<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Historicos;
use App\Models\Productos;
use DB;

class HistoricoController extends Controller
{
    public function __construct()
    {
        $this->middleware('alarmas');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['historicos'] = Historicos::orderBy('id', 'desc')->paginate(5);
        return view('historicos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historicos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mytime = Carbon::now();
        $time = $mytime->toDateTimeString();

        $request->validate([
            'cantidad' => 'required',
        ]);

        $producto = Productos::find($request->producto_id)->first();

        $historico1 = new Historicos;
        $historico1->cantidad = $request->cantidad;
        $historico1->fecha_hora = $time;
        $historico1->productos_id = $producto->id;

        $historico1->save();
        $historico1->productos()->associate($producto);

        return redirect()->route('historicos.index')
            ->with('success', 'Historico has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historico = Historicos::find($id)->first();
        return view('historicos.show', compact('historico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $historicos = Historicos::selectRaw('*')->where('id', 'like', $id)->first();
        return view('historicos.edit', compact('historicos'));
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
            'cantidad' => 'required',
            'fecha_hora' => 'required',
            'producto_id' => 'required',
        ]);

        $historico1 = Historicos::find($id);
        $historico1->cantidad = $request->cantidad;
        $historico1->fecha_hora = $request->fecha_hora;
        $historico1->productos_id = $request->producto_id;

        $historico1->save();

        return redirect()->route('historicos.index')
            ->with('success', 'Historico has been created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historico = Historicos::find($id);
        $historico->delete();
        return redirect()->route('historicos.index')
            ->with('success', 'historicos has been deleted successfully');
    }
}
