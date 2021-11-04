<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedores;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['proveedores'] = Proveedores::orderBy('id', 'desc')->paginate(5);
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
        $request->validate([
            'telefono' => 'required',
            'nombre' => 'required',
            'web' => 'required',
        ]);
        $proveedor = new Proveedores;
        $proveedor->telefono = $request->telefono;
        $proveedor->nombre = $request->nombre;
        $proveedor->web = $request->web;
        $proveedor->save();
        return redirect()->route('proveedores.index')
            ->with('success', 'proveedor has been created successfully.');
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

        $request->validate([
            'telefono' => 'required',
            'nombre' => 'required',
            'web' => 'required',
        ]);
        $proveedor = Proveedores::find($id);
        $proveedor->telefono = $request->telefono;
        $proveedor->nombre = $request->nombre;
        $proveedor->web = $request->web;
        $proveedor->save();
        return redirect()->route('proveedores.index')
            ->with('success', 'proveedor Has Been updated successfully');
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
            ->with('success', 'proveedor has been deleted successfully');
    }
}
