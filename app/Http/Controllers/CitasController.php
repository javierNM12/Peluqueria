<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;

class CitasController extends Controller
{
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
        $citas = new Citas;
        $citas->fecha_hora = $request->fecha_hora;
        $citas->descripcion = $request->descripcion;
        $citas->finalizado = $request->finalizado;
        $citas->save();


        // $data = [
        //     $request->proveedor => ['precio' => $request->precio],
        // ];
        // $cliente->proveedores()->sync($data);
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
            'finalizado' => 'required',
        ]);
        $cita = Citas::find($id);
        $cita->fecha_hora = $request->fecha_hora;
        $cita->descripcion = $request->descripcion;
        $cita->finalizado = $request->finalizado;
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
        $cita->delete();
        return redirect()->route('citas.index')
            ->with('success', 'Client has been deleted successfully');
    }
}
