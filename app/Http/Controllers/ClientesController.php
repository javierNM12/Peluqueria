<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('alarmas');
    }
    
    public function historicoclientes(Request $request)
    {
        $historico = Clientes::find($request->id)->citas()->get();

        return response()->json($historico);
        //return view('productos.listarcompras', compact(['productos', 'historicos']));
    }

    public function formhistorial()
    {
        $clientes = Clientes::get();
        return view('clientes.formhistorial', compact('clientes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['clientes'] = Clientes::orderBy('id', 'desc')->simplePaginate(5);
        return view('clientes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'descripcion' => 'required',
        ]);
        $cliente = new Clientes;
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->descripcion = $request->descripcion;
        $cliente->save();


        // $data = [
        //     $request->proveedor => ['precio' => $request->precio],
        // ];
        // $cliente->proveedores()->sync($data);
        return redirect()->route('clientes.index')
            ->with('success', 'Client has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientes = clientes::find($id)->first();
        return view('clientes.show', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = Clientes::selectRaw('*')->where('id', 'like', $id)->first();
        return view('clientes.edit', compact('clientes'));
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
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'descripcion' => 'required',
        ]);
        $cliente = Clientes::find($id);
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->telefono = $request->telefono;
        $cliente->descripcion = $request->descripcion;
        $cliente->save();
        return redirect()->route('clientes.index')
            ->with('success', 'Client Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Clientes::find($id);
        $cliente->delete();
        return redirect()->route('clientes.index')
            ->with('success', 'Client has been deleted successfully');
    }
}
