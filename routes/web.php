<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\GiftController;


use Illuminate\Support\Facades\Route;

//admin 
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('can:admin');
Route::resource('speakers', SpeakerController::class)->middleware('can:admin');
Route::resource('events', EventController::class)->middleware('can:admin');
Route::get('registered', [RegisteredController::class, 'index'])->middleware('can:admin');
Route::get('gifts', [GiftController::class, 'index'])->middleware('can:admin');

//paginas publica
Route::get('/', [PageController::class, 'index']);
Route::get('virtualmeet', [PageController::class, 'evento']);
Route::get('conferencias-workshops', [PageController::class, 'conferencias']);
Route::get('speaker', [PageController::class, 'speakers']);

// paquetes de registro al evento
Route::get('packages', [RecordController::class, 'paquetes']);

// pagar
Route::post('finish-registration/pay', [RecordController::class, 'pagar']);

Route::middleware('can:admin,user')->group(function () {
    Route::get('ticket', [RecordController::class, 'boleto']);
    Route::post('finalizar-registro/gratis', [RecordController::class, 'paqueteGratis']);
    Route::get('finalizar-registro/conferencias', [RecordController::class, 'elegirConferencia']);
});

//elegir conferencias 
Route::post('finalizar-registro/conferencias', [RecordController::class, 'postRegistroConferencia']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
