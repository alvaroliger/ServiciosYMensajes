<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\ConversationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// RUTA DEL DASHBOARD
Route::middleware(['auth'])->get('/dashboard', function () {
    $services = auth()->user()->services;
    return view('dashboard', compact('services'));
})->name('dashboard');

// LISTADO DE SERVICIOS
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// DETALLE DE SERVICIO
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// RUTA PARA COMENTARIOS EN EL MISMO SERVICIO
//Route::post('/services/{id}', [ServiceController::class, 'comentar'])->name('services.comentar');

// (Puedes eliminar esta si ya no usas MessageController directamente)
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/conversations', [ConversationController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});
