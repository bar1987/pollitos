<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnosDisponiblesController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas públicas para ver turnos disponibles
Route::get('/canchas/{canchaId}/turnos', [TurnosDisponiblesController::class, 'show'])->name('turnos-disponibles');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Ruta para reservar turno (requiere autenticación)
    Route::post('/reservar-turno', [TurnosDisponiblesController::class, 'reservar'])->name('reservar-turno');
});
