<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicios;

class ServiciosController extends Controller
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
        $data['servicios'] = Servicios::orderBy('id', 'desc')->paginate(5);
        return view('servicios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicios.create');
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
            'precio' => 'required',
            'nombre' => 'required',
            'desc' => 'required',
        ]);
        $servicios = new servicios;
        $servicios->precio = $request->precio;
        $servicios->nombre = $request->nombre;
        $servicios->desc = $request->desc;
        $servicios->save();


        // $data = [
        //     $request->proveedor => ['precio' => $request->precio],
        // ];
        // $cliente->proveedores()->sync($data);
        return redirect()->route('servicios.index')
            ->with('success', 'servicios has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicios = Servicios::find($id)->first();
        return view('servicios.show', compact('servicios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicios = Servicios::selectRaw('*')->where('id', 'like', $id)->first();
        return view('servicios.edit', compact('servicios'));
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
            'precio' => 'required',
            'nombre' => 'required',
            'desc' => 'required',
        ]);
        $servicio = Servicios::find($id);
        $servicio->precio = $request->precio;
        $servicio->nombre = $request->nombre;
        $servicio->desc = $request->desc;
        $servicio->save();
        return redirect()->route('servicios.index')
            ->with('success', 'servicio Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio = Servicios::find($id);
        $servicio->delete();
        return redirect()->route('servicios.index')
            ->with('success', 'Client has been deleted successfully');
    }
}
