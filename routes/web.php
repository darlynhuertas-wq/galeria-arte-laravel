<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CarritoController;

// RUTAS PÚBLICAS (Invitados)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.procesar');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// RUTAS COMPARTIDAS (Autenticados)
Route::middleware(['auth'])->group(function() {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/perfil/nombre', [PerfilController::class, 'updateNombre'])->name('perfil.nombre');
    Route::put('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password');
});

// RUTAS ADMINISTRADOR (Gestión de Catálogo CRUD)
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('artistas', ArtistaController::class)->except(['show']);
    Route::resource('obras', ObraController::class);
});

// RUTAS USUARIO COMÚN (Galería y Carrito con Retos)
Route::middleware(['auth'])->group(function () {
    // Rutas del Catálogo Público e Interfaz de Galería
    Route::get('/galeria', [CarritoController::class, 'galeria'])->name('galeria.index');
    
    // Operaciones Centrales del Carrito de Compras
    Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito.ver');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/incrementar/{id}', [CarritoController::class, 'incrementar'])->name('carrito.incrementar');
    Route::post('/carrito/decrementar/{id}', [CarritoController::class, 'decrementar'])->name('carrito.decrementar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

    // Mantenimientos CRUD del Administrador (Opcionales por si usas recursos)
    Route::resource('obras', ObraController::class);
    Route::resource('artistas', ArtistaController::class);
});