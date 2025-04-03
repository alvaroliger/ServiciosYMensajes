<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\ConversationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TikTokController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard solo si está autenticado
Route::middleware(['auth'])->get('/dashboard', function () {
    $services = auth()->user()->services;
    return view('dashboard', compact('services'));
})->name('dashboard');

//Route::get('/services/{id}', [ServiceController::class, 'showSinC'])->name('services.showSinC');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile/tiktok', [TikTokController::class, 'redirigirATiktok'])->name('tiktok.redirigir');
    Route::get('/user/profile/tiktok/callback', [TikTokController::class, 'vincular'])->name('tiktok.callback');
});

Route::view('/politica-de-privacidad', 'privacy-policy');
Route::view('/terminos-de-servicio', 'terms-of-service');

