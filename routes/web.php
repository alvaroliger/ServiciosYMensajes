<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\ConversationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard solo si está autenticado
Route::middleware(['auth'])->get('/dashboard', function () {
    $services = auth()->user()->services;
    return view('dashboard', compact('services'));
})->name('dashboard');

// Comentarios: esta es la forma correcta
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// Conversaciones
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/conversations', [ConversationController::class, 'store']);
});

// Rutas protegidas para servicios (crea, edita, elimina, etc.)
Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});
