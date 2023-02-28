<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\PonentesController;
use App\Http\Controllers\RegistradosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\RegalosController;


use Illuminate\Support\Facades\Route;


//admin 
Route::get('dashboard',[DashboardController::class, 'index'])->middleware('can:admin');
Route::resource('ponentes', PonentesController::class)->middleware('can:admin');
Route::resource('eventos', EventosController::class)->middleware('can:admin');
Route::get('registrados',[RegistradosController::class, 'index'])->middleware('can:admin');
Route::get('regalos',[RegalosController::class, 'index'])->middleware('can:admin');



//paginas publica
Route::get('/',[PaginasController::class, 'index']);
Route::get('/virtualmeet', [PaginasController::class, 'evento']);
Route::get('/conferencias-workshops', [PaginasController::class, 'conferencias']);

// paquetes de registro al evento
Route::get('/paquetes', [RegistroController::class, 'paquetes']);
Route::get('/finalizar-registro/gratis', [RegistroController::class, 'paqueteGratis'])->middleware(['auth', 'can:admin,user']);

// pagar
Route::post('/finalizar-registro/pagar', [RegistroController::class, 'pagar']);

//boletos virtuales
Route::get('/boleto', [RegistroController::class, 'boleto'])->middleware('can:admin,user');

//elegir conferencias 
Route::get('/finalizar-registro/conferencias', [RegistroController::class, 'elegirConferencia'])->middleware(['auth', 'can:admin,user']);
Route::post('/finalizar-registro/conferencias', [RegistroController::class, 'postRegistroConferencia']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
