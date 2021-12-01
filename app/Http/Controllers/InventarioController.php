<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Proveedores;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Historicos;
use App\Models\Inventario;


class InventarioController extends Controller
{
    public function compras()
    {
        $productos = Productos::selectRaw('*')->whereRaw('tipo = 1')->get(); // 1 = productos de venta
        $inventario = Inventario::selectRaw('productos_id, COUNT(id) as existencias')->groupBy('productos_id')->get();
        return view('productos.compras', compact(['productos', 'inventario']));
    }
    public function addproductos()
    {
        $productos = Productos::selectRaw('*')->whereRaw('tipo = 1')->get(); // 1 = productos de venta
        $inventario = Inventario::selectRaw('productos_id, COUNT(id) as existencias')->groupBy('productos_id')->get();
        $proveedores = Proveedores::select('*')->get();
        return view('productos.addproductos', compact(['productos', 'inventario', 'proveedores']));
    }

    public function actuinventario()
    {
        $productos = Productos::whereRaw("tipo = 1")->get();
        // SELECT `productos_id`, COUNT(`id`) as cantidad FROM `inventarios` GROUP BY `productos_id`; 
        $inventario = Inventario::selectRaw('productos_id, COUNT(id) as existencias')->groupBy('productos_id')->get();
        return view('productos.actualizar', compact(['productos', 'inventario']));
    }

    public function storeactuproductos(Request $request)
    {
        $id = Auth::id();
        $mytime = Carbon::now();

        $contador = 0;
        $precio = 0;
        for ($i = 0; $i < count($request->get('producto')); $i++) {
            $producto = Productos::find($request->get('producto')[$i]);
            if ($request->accion == "actu" or $request->accion == "compra") {
                for ($f = 0; $f < $request->get('cantidad')[$i]; $f++) {
                    $item = Inventario::select("*")->whereRaw('productos_id = ' . $request->get('producto')[$i])->orderBy('created_at', 'ASC')->first();
                    if ($item != null) {
                        $item->delete();
                        $precio += $item->precio;
                        $contador--;
                    }
                }
            } else if ($request->accion == "add") {
                for ($f = 0; $f < $request->get('cantidad')[$i]; $f++) {
                    $item = new Inventario();
                    $item->productos_id = $request->get('producto')[$i];
                    $item->proveedores_id = $request->get('proveedores')[$i];
                    $item->precio = $request->get('precio')[$i];
                    $item->save();
                }
            }

            $historico = new Historicos();
            $historico->users_id = $id;
            $historico->cantidad = $contador;
            $historico->precio = $precio;
            $historico->fecha_hora = $mytime->toDateTimeString();

            $producto->historico()->save($historico);
        }


        return redirect()->route('inventario.index')
            ->with('success', 'Inventario actualizado correctamente.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['productos'] = Productos::orderBy('id', 'asc')->simplePaginate(5);

        foreach ($data['productos'] as $key => $producto) {
            $data['inventario'][$producto['id']] = $producto->inventario()->get();
        }

        return view('inventario.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
