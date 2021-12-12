<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedores;
use App\Models\Productos;
use App\Models\Inventario;

class ProveedorController extends Controller
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
        $data['proveedores'] = Proveedores::orderBy('id', 'desc')->simplePaginate(5);
        return view('proveedores.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
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
            'nombre' => 'required|string',
            'telefono' => 'required|string',
            'web' => 'required|string',
        ];
    
        $customMessages = [
            'required' => 'El campo :attribute no se puede dejar en blanco.',
            'string' => 'El campo :attribute debe ser texto.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $proveedor = new Proveedores;
        $proveedor->telefono = $request->telefono;
        $proveedor->nombre = $request->nombre;
        $proveedor->web = $request->web;
        $proveedor->save();
        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedores = Proveedores::find($id)->first();
        return view('proveedores.show', compact('proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedores = Proveedores::selectRaw('*')->where('id', 'like', $id)->first();
        return view('proveedores.edit', compact('proveedores'));
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
            'nombre' => 'required|string',
            'telefono' => 'required|string',
            'web' => 'required|string',
        ];
    
        $customMessages = [
            'required' => 'El campo :attribute no se puede dejar en blanco.',
            'string' => 'El campo :attribute debe ser texto.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $proveedor = Proveedores::find($id);
        $proveedor->telefono = $request->telefono;
        $proveedor->nombre = $request->nombre;
        $proveedor->web = $request->web;
        $proveedor->save();
        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedores::find($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente');
    }
}
