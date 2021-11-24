<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedores;
use App\Models\Productos;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('alarmas');
    }

    #region
    // AL CAMBIAR LA TABLA YA NO GUARDAMOS QUE PRODUCTOS VENDE CADA PROVEEDOR
    // DEPRECATED
    /*public function formaddproductos()
    {
        $data['proveedores'] = Proveedores::get();

        foreach ($data['proveedores'] as $key => $value) {
            $data['productos'][$value->id] = Proveedores::find($value->id)->productos()->get();
        }
        //var_dump(Proveedores::find(1)->productos()->get());exit;

        $productos = Productos::get();

        return view('proveedores.addproductos', compact(['data', 'productos']));
    }

    public function storeaddproductos(Request $request)
    {
        $datosrecuperados = json_decode($request->datos);

        $proveedor = Proveedores::find($request->proveedor)->first();
        $productos = Productos::get();
        
        for ($i = 0; $i < count($productos); $i++) { //recorro todos los productos disponibles
            if (isset($datosrecuperados[$productos[$i]['id']])) { //compruebo que ese producto ha sido enviado
                $new[$i] = array('productos_id' => $productos[$i]['id'], 'precio' => $datosrecuperados[$productos[$i]['id']], 'proveedores_id' => $proveedor->id);
            }
        }
        $proveedor->productos()->sync($new);

        return redirect()->route('proveedores.index')
            ->with('success', 'proveedor has been created successfully.');
    }*/
    #endregion

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
