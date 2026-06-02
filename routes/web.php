<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DashboardController;

// RUTAS PÚBLICAS (Invitados)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::post('/login', [AuthController::class, 'login'])->name('login.procesar');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// RUTAS COMPARTIDAS (Autenticados: admin y usuario)
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/perfil/nombre', [PerfilController::class, 'updateNombre'])->name('perfil.nombre');
    Route::put('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password');
});

// RUTAS SOLO ADMINISTRADOR (CRUD de catálogo)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('artistas', ArtistaController::class)->except(['show']);
    Route::resource('obras', ObraController::class);
});

// RUTAS SOLO USUARIO NORMAL (Galería y Carrito)
Route::middleware(['auth', 'role:usuario'])->group(function () {
    Route::get('/galeria', [CarritoController::class, 'galeria'])->name('galeria.index');
    Route::get('/galeria/obra/{id}', [CarritoController::class, 'detalle'])->name('galeria.detalle');

    Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito.ver');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/incrementar/{id}', [CarritoController::class, 'incrementar'])->name('carrito.incrementar');
    Route::post('/carrito/decrementar/{id}', [CarritoController::class, 'decrementar'])->name('carrito.decrementar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    Route::get('/mis-compras', [CarritoController::class, 'misCompras'])->name('mis-compras');
});