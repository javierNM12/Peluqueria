<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Historicos;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class ProductoController extends Controller
{

    public function actuinventario()
    {
        $productos = Productos::get();
        return view('productos.actualizar', compact('productos'));
    }

    public function compras()
    {
        $productos = Productos::selectRaw('*')->whereRaw('tipo = 0')->get(); // 0 = productos de venta
        return view('productos.compras', compact('productos'));
    }

    public function listarcompras()
    {
        $productos = Productos::selectRaw('*')->whereRaw('tipo = 0')->get(); // 0 = productos de venta
        foreach ($productos as $key => $value) {
            $historicos[$value->id] = Productos::find($value->id)->historico()->get();
        }
        return view('productos.listarcompras', compact(['productos', 'historicos']));
    }

    public function storeactuproductos(Request $request)
    {

        $id = Auth::id();
        $mytime = Carbon::now();

        for ($i = 0; $i < count($request->get('producto')); $i++) {
            $producto = Productos::find($request->get('producto')[$i]);
            if ($request->accion == "actu") {
                $cantidad = $producto->existencias + $request->get('cantidad')[$i];
            } else {
                $cantidad = $producto->existencias - $request->get('cantidad')[$i];
            }

            $producto->existencias = $cantidad;
            $producto->save();

            $historico = new Historicos();
            $historico->users_id = $id;
            $historico->cantidad = $request->get('cantidad')[$i];
            $historico->fecha_hora = $mytime->toDateTimeString();

            $producto->historico()->save($historico);
        }


        return redirect()->route('productos.index')
            ->with('success', 'Company has been created successfully.');
    }

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
            'tipo' => 'required'
        ]);
        $producto = new Productos;
        $producto->nombre = $request->nombre;
        $producto->existencias = $request->existencias;
        $producto->minimo = $request->minimo;
        $producto->pvp = $request->pvp;
        $producto->tipo = $request->tipo;
        $producto->save();

        for ($i = 0; $i < count($request->get('proveedor')); $i++) {
            $new[$i] = array('proveedores_id' => $request->get('proveedor')[$i], 'precio' => $request->get('precio')[$i]);
        }

        /*foreach ($request->get('proveedor') as $dato => $value) {
            foreach ($request->get('precio') as $dato2 => $value2) {
                $new[$dato] = array('proveedores_id' => $value, 'precio' => $value2);
            }
        }*/

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
