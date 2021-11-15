<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Proveedores;
use DB;

class ProductoController extends Controller
{

    public function actuinventario()
    {
        $productos = Productos::get();

        return view('productos.actualizar', compact('productos'));
    }

    public function storeactuproductos(Request $request)
    {
        foreach ($request->get('producto') as $prod => $value) {
            foreach ($request->get('cantidad') as $cant => $value2) {
                $producto = Productos::find($value);
                $cantidad = $producto->existencias + $value2;
                $producto->existencias = $cantidad;
                $producto->save();
            }
        }
        return redirect()->route('productos.index')
            ->with('success', 'Company has been created successfully.');
    }

    /*public function getProductos()
    {
        $productos = Productos::with('proveedores')->find(1)->first();
            echo "</br>*****</br>";
            echo $productos;
            echo "</br>*****</br>";
            for ($z=0; $z < count($productos['proveedores']); $z++) { 
                echo "</br>-----</br>";
                echo $productos['proveedores'][$z]['pivot']['producto_id'];
                echo "</br>-----</br>";
            }
        exit;
    }*/


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['productos'] = Productos::orderBy('id', 'desc')->paginate(5);
        return view('productos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedores::get();

        return view('productos.create', compact('proveedores'));
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
            'existencias' => 'required',
            'minimo' => 'required',
            'pvp' => 'required',
        ]);
        $producto = new Productos;
        $producto->nombre = $request->nombre;
        $producto->existencias = $request->existencias;
        $producto->minimo = $request->minimo;
        $producto->pvp = $request->pvp;
        $producto->save();


        foreach ($request->get('proveedor') as $dato => $value) {
            foreach ($request->get('precio') as $dato2 => $value2) {
                $new[$dato] = array('proveedores_id' => $value, 'precio' => $value2);
            }
        }

        $producto->proveedores()->sync($new);

        return redirect()->route('productos.index')
            ->with('success', 'Company has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Productos $productos
        // $productos = Productos::selectRaw('*')->where('id', 'like', $id)->first();
        $productos = Productos::find($id)->first();
        return view('productos.show', compact('productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos = Productos::selectRaw('*')->where('id', 'like', $id)->first();
        return view('productos.edit', compact('productos'));
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
            'existencias' => 'required',
            'minimo' => 'required',
            'pvp' => 'required',
        ]);
        $producto = Productos::find($id);
        $producto->nombre = $request->nombre;
        $producto->existencias = $request->existencias;
        $producto->minimo = $request->minimo;
        $producto->pvp = $request->pvp;
        $producto->save();
        return redirect()->route('productos.index')
            ->with('success', 'Company Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Productos::find($id);

        $producto->historico()->delete();
        $producto->proveedores()->detach();

        $producto->delete();
        return redirect()->route('productos.index')
            ->with('success', 'Company has been deleted successfully');
    }

    /* Get listado de alarmas */
    public function getAlarmas()
    {
        $productos = Productos::selectRaw('*')->whereRaw('existencias < minimo')->get();
        return $productos;
    }
}
