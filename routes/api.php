<?php

use App\Http\Controllers\VolController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────
// Routes publiques (sans connexion)
// ─────────────────────────────────────

// Inscription et connexion
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Recherche de vols (visible par tous)
Route::get('/vols',          [VolController::class, 'index']);
Route::get('/vols/retour', [VolController::class, 'volsRetour']);
Route::get('/vols/search',   [VolController::class, 'search']);
Route::get('/vols/{id}',     [VolController::class, 'show']);

// ─────────────────────────────────────
// Routes protégées (connexion requise)
// ─────────────────────────────────────

Route::middleware('auth:sanctum')->group(function () {

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout']);

    // Mes réservations
    Route::get('/mes-reservations', [ReservationController::class, 'mesReservations']);
    Route::post('/reservations',    [ReservationController::class, 'store']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

    // ─────────────────────────────────
    // Routes Admin uniquement
    // ─────────────────────────────────
    Route::middleware('admin')->group(function () {
        

        Route::post('/vols',           [VolController::class, 'store']);
        Route::put('/vols/{id}',       [VolController::class, 'update']);
        Route::delete('/vols/{id}',    [VolController::class, 'destroy']);
        Route::get('/reservations',    [ReservationController::class, 'index']);
        Route::get('/reservations/{id}', [ReservationController::class, 'show']);
        // Dans le groupe middleware admin
Route::get('/users',          [UserController::class, 'index']);
Route::delete('/users/{id}',  [UserController::class, 'destroy']);
    });
});