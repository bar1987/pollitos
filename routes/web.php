<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnosDisponiblesController;

Route::get('/', [TurnosDisponiblesController::class, 'index'])->name('welcome');

// Rutas protegidas - requieren autenticación
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/canchas/{canchaId}/turnos', [TurnosDisponiblesController::class, 'show'])->name('turnos-disponibles');
    Route::post('/reservar-turno', [TurnosDisponiblesController::class, 'reservar'])->name('reservar-turno');
    Route::post('/procesar-pago', [TurnosDisponiblesController::class, 'procesarPago'])->name('procesar-pago');
    
    // Rutas de pago
    Route::get('/pago/transferencia', [TurnosDisponiblesController::class, 'pagoTransferencia'])->name('pago-transferencia');
    Route::get('/pago/efectivo', [TurnosDisponiblesController::class, 'pagoEfectivo'])->name('pago-efectivo');
    Route::post('/confirmar-pago', [TurnosDisponiblesController::class, 'confirmarPago'])->name('confirmar-pago');
    
    Route::get('/confirmacion-turno/{turno}', [TurnosDisponiblesController::class, 'confirmacionTurno'])->name('confirmacion-turno');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

