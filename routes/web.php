<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Si el usuario está autenticado, lo mandamos al dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Si no, se muestra la pantalla de login (Breeze)
    return view('auth.login');
});

// 🧩 Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // 🏠 Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 👤 Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🥬 Módulo de Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

    // 🧾 Módulo de Compras
    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');

    // 💰 Módulo de Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');

    // 🚪 Cerrar sesión manualmente
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

// ⚙️ Rutas de autenticación generadas por Breeze
require __DIR__.'/auth.php';

