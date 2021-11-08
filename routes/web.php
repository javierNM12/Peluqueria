<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeluqueriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ServiciosController;

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
Route::POST('ajax/eliminarcita', [CitasController::class, 'eliminar'])->name('ajaxcita.eliminar');
Route::POST('ajax/crearcita', [CitasController::class, 'store'])->name('ajaxcita.crear');
Route::POST('ajax/listarcita', [CitasController::class, 'listar'])->name('ajaxcita.listar');

//.----****** CRUDS ******----.//

// CRUD Productos
Route::resource('productos', ProductoController::class);

// CRUD Proveedores
Route::resource('proveedores', ProveedorController::class);

// CRUD Productos_proveedores
Route::resource('productos_proveedores', ProveedorController::class);

// CRUD Clientes
Route::resource('clientes', ClientesController::class);

// CRUD Citas
Route::resource('citas', CitasController::class);

// CRUD servicios
Route::resource('servicios', ServiciosController::class);


// Inicio del sitio
Route::get('/', [PeluqueriaController::class, 'inicio'])->name('inicio');
Route::get('/dashboard', [PeluqueriaController::class, 'inicio'])->middleware(['alarmas'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//CODIGO EJEMPLO AJAX
/*
Route::get('ajax/finalizar', [StudentController::class, 'ajaxRequest'])->name('ajax.request');

Route::post('ajax/request/store', [StudentController::class, 'ajaxRequestStore'])->name('ajax.request.store');
*/