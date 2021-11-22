<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeluqueriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\CitasServiciosController;
use App\Http\Controllers\InventarioController;

// COMENTARIO PARA COMPROBAR QUE SE SUBE BIEN LOS FICHEROS

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    Route::get('/add_peli', [CineController::class, 'addPeli'])->name('addPeli')->middleware(['auth']);
    Route::post('/store_peli', [CineController::class, 'storePeli'])->name('storePeli')->middleware(['auth']);
*/

// add -> add_{item} (introducir datos)
// store -> store_{item} (guardar datos)

// {{ Route('storeRetar') }} || ->name('dashboard');



// .----****** ROUTES AJAX ******----.//
Route::POST('ajax/finalizarcita', [CitasController::class, 'finalizar'])->name('ajaxcita.finalizar');
Route::POST('ajax/cancelarcita', [CitasController::class, 'cancelar'])->name('ajaxcita.cancelar');
Route::POST('ajax/eliminarcita', [CitasController::class, 'eliminar'])->name('ajaxcita.eliminar');
Route::POST('ajax/crearcita', [CitasController::class, 'store'])->name('ajaxcita.crear');
Route::POST('ajax/listarcita', [CitasController::class, 'listar'])->name('ajaxcita.listar');
Route::POST('ajax/horas', [CitasController::class, 'horas'])->name('ajaxcita.horas');
Route::POST('ajax/historicoclientes', [ClientesController::class, 'historicoclientes'])->name('ajax.historicoclientes');
Route::POST('ajax/historicoventas', [ProductoController::class, 'historicoventas'])->name('ajax.historicoventas');
Route::POST('ajax/historicocitas', [CitasController::class, 'historicocitas'])->name('ajax.historicocitas');

// .----****** CRUDS ******----.//

// CRUD Productos
Route::resource('productos', ProductoController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD Proveedores
Route::resource('proveedores', ProveedorController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD Productos_proveedores
Route::resource('productos_proveedores', ProveedorController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD Clientes
Route::resource('clientes', ClientesController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD Citas
Route::resource('citas', CitasController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD servicios
Route::resource('servicios', ServiciosController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD historico
Route::resource('historicos', HistoricoController::class)->middleware(['alarmas'])->middleware(['auth']);

// CRUD citas_servicios
Route::resource('citasservicios', CitasServiciosController::class)->middleware(['alarmas'])->middleware(['auth']);


// .----****** RUTAS ******----.//

// Mostrar formulario para actualizar el inventario
Route::get('/actuinventario', [InventarioController::class, 'actuinventario'])->middleware(['alarmas'])->middleware(['auth'])->name('actuinventario');
Route::POST('/storeactuproductos', [InventarioController::class, 'storeactuproductos'])->middleware(['alarmas'])->middleware(['auth'])->name('storeactuproductos');

// Mostrar formulario para realizar compras presenciales
Route::get('/compras', [ProductoController::class, 'compras'])->middleware(['alarmas'])->middleware(['auth'])->name('compras');

// Listar las compras
Route::get('/listarcompras', [ProductoController::class, 'listarcompras'])->middleware(['alarmas'])->middleware(['auth'])->name('listarcompras');

// Permitir elegir el cliente para ver su historial
Route::get('/formhistorial', [ClientesController::class, 'formhistorial'])->middleware(['alarmas'])->middleware(['auth'])->name('formhistorial');

// Seleccionar tramo de fechas historico citas
Route::get('/formhistoricocitas', [CitasController::class, 'formhistorico'])->middleware(['alarmas'])->middleware(['auth'])->name('formhistoricocitas');






// Inicio del sitio
Route::get('/', [PeluqueriaController::class, 'inicio'])->middleware(['alarmas'])->middleware(['auth'])->name('inicio');
Route::get('/dashboard', [PeluqueriaController::class, 'inicio'])->middleware(['alarmas'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';