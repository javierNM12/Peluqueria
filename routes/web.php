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

use App\Http\Controllers\PinController;

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
Route::POST('ajax/finalizarcita', [CitasController::class, 'finalizar'])->middleware(['auth'])->name('ajaxcita.finalizar');
Route::POST('ajax/cancelarcita', [CitasController::class, 'cancelar'])->middleware(['auth'])->name('ajaxcita.cancelar');
Route::POST('ajax/eliminarcita', [CitasController::class, 'eliminar'])->middleware(['auth'])->name('ajaxcita.eliminar');
Route::POST('ajax/crearcita', [CitasController::class, 'store'])->middleware(['auth'])->name('ajaxcita.crear');
Route::POST('ajax/listarcita', [CitasController::class, 'listar'])->middleware(['auth'])->name('ajaxcita.listar');
Route::POST('ajax/horas', [CitasController::class, 'horas'])->middleware(['auth'])->name('ajaxcita.horas');
Route::POST('ajax/historicoclientes', [ClientesController::class, 'historicoclientes'])->middleware(['auth'])->name('ajax.historicoclientes');
Route::POST('ajax/historicoventas', [ProductoController::class, 'historicoventas'])->middleware(['auth'])->name('ajax.historicoventas');
Route::POST('ajax/historicocitas', [CitasController::class, 'historicocitas'])->middleware(['auth'])->name('ajax.historicocitas');
Route::POST('ajax/productoscantidadproductoid', [InventarioController::class, 'productoscantidadproductoid'])->middleware(['auth'])->name('ajax.productoscantidadproductoid');
Route::POST('ajax/productoscantidadproveedorid', [InventarioController::class, 'productoscantidadproveedorid'])->middleware(['auth'])->name('ajax.productoscantidadproveedorid');
Route::POST('ajax/citascantidadclientesid', [CitasController::class, 'citascantidadclientesid'])->middleware(['auth'])->name('ajax.citascantidadclientesid');
Route::POST('ajax/citascantidadserviciosid', [CitasServiciosController::class, 'citascantidadserviciosid'])->middleware(['auth'])->name('ajax.citascantidadserviciosid');
Route::GET('ajax/pdf', [PeluqueriaController::class, 'generatePDF'])->middleware(['auth'])->name('ajax.pdf');


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

// CRUD inventario
Route::resource('inventario', InventarioController::class)->middleware(['alarmas'])->middleware(['auth']);


// .----****** RUTAS ******----.//

// Mostrar formulario para actualizar el inventario
Route::get('/actuinventario', [InventarioController::class, 'actuinventario'])->middleware(['alarmas'])->middleware(['auth'])->middleware('pin')->name('actuinventario');
Route::POST('/storeactuproductos', [InventarioController::class, 'storeactuproductos'])->middleware(['alarmas'])->middleware(['auth'])->name('storeactuproductos');

// Mostrar formulario para realizar compras presenciales
Route::get('/compras', [InventarioController::class, 'compras'])->middleware(['alarmas'])->middleware(['auth'])->name('compras');

// Mostrar el formulario para añadir productos al inventario
Route::get('/addproductos', [InventarioController::class, 'addproductos'])->middleware(['alarmas'])->middleware(['auth'])->middleware('pin')->name('addproductos');

// Listar las compras
Route::get('/listarcompras', [ProductoController::class, 'listarcompras'])->middleware(['alarmas'])->middleware(['auth'])->name('listarcompras');

// Permitir elegir el cliente para ver su historial
Route::get('/formhistorial', [ClientesController::class, 'formhistorial'])->middleware(['alarmas'])->middleware(['auth'])->name('formhistorial');

// Seleccionar tramo de fechas historico citas
Route::get('/formhistoricocitas', [CitasController::class, 'formhistorico'])->middleware(['alarmas'])->middleware(['auth'])->name('formhistoricocitas');

// Form cambiar ajustes admin
Route::get('/formajustes', [PeluqueriaController::class, 'formajustes'])->middleware(['alarmas'])->middleware(['auth'])->name('formajustes');

// Guardar ajustes admin
Route::post('/guardarajustes', [PeluqueriaController::class, 'guardarajustes'])->middleware(['alarmas'])->middleware(['auth'])->name('guardarajustes');

// Finalizar cita desde el index de citas
Route::get('/fincita/{id}', [CitasController::class, 'fincita'])->middleware(['auth'])->name('fincita');

Route::get('/canelcita/{id}', [CitasController::class, 'canelcita'])->middleware(['auth'])->name('canelcita');

// Ruta para el "Acerca del autor"
Route::get('/acercade', [PeluqueriaController::class, 'acercade'])->middleware(['alarmas'])->middleware(['auth'])->name('acercade');


Route::get('pin/create', function () {
    return view('create');
})->name('pin.create');

//Route::post('pin/store', 'PinController@store')->name('pin.store')->middleware('throttle:3,1');
Route::post('pin/store', [PinController::class, 'store'])->middleware(['throttle:3,1'])->name('pin.store'); // 3 intentos en 1 minuto


// Inicio del sitio
Route::get('/', [PeluqueriaController::class, 'inicio'])->middleware(['alarmas'])->middleware(['auth'])->name('inicio');
Route::get('/dashboard', [PeluqueriaController::class, 'inicio'])->middleware(['alarmas'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
