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

    /*
    |--------------------------------------------------------------------------
    | 🥬 MÓDULO DE PRODUCTOS
    |--------------------------------------------------------------------------
    */
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/productos/pdf', [ProductoController::class, 'generarPDF'])->name('productos.pdf');

    /*
    |--------------------------------------------------------------------------
    | 🧾 MÓDULO DE COMPRAS
    |--------------------------------------------------------------------------
    */
    Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
    Route::get('/compras/create', [CompraController::class, 'create'])->name('compras.create');
    Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
    Route::get('/compras/{compra}/edit', [CompraController::class, 'edit'])->name('compras.edit');
    Route::put('/compras/{compra}', [CompraController::class, 'update'])->name('compras.update');
    Route::delete('/compras/{compra}', [CompraController::class, 'destroy'])->name('compras.destroy');
    Route::get('/compras/pdf', [CompraController::class, 'generarPDF'])->name('compras.pdf');

    
    /*
|--------------------------------------------------------------------------
| 💰 MÓDULO DE VENTAS
|--------------------------------------------------------------------------
*/
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');
Route::get('/ventas/{venta}/pdf', [VentaController::class, 'generarPDF'])->name('ventas.pdf');
    /*
    |--------------------------------------------------------------------------
    | 🚪 CERRAR SESIÓN MANUAL
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

// ⚙️ Rutas de autenticación generadas por Breeze
require __DIR__.'/auth.php';
