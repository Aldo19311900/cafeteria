<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreditTransactionsController;
use App\Http\Controllers\InventoryAjustmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas para el rol con role_id = 1 (admin)
Route::middleware(['auth', 'verified', 'role:2'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    // Rutas para gestión de productos
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Rutas para gestión de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/{user}/add-credit', [UserController::class, 'addCredit'])->name('users.add.credit');

    //Rutas para transacciones
    Route::get('/transactions', [CreditTransactionsController::class, 'transactionsIndex'])->name('transactions');


    //Rutas para el inventario de productos
    Route::get('/inventory-adjustments', [InventoryAjustmentController::class, 'index'])->name('inventory.adjustments');

});

// Rutas para el rol con role_id = 2 (usuarios de cafetería)
Route::middleware(['auth', 'verified', 'role:1'])->group(function () {
    Route::get('/cafeteria', function () {
        return view('cafeteria.index');
    })->name('cafeteria.dashboard');
});

// Rutas compartidas (perfil)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::get('/manifest.json', function () {
    return view('vendor.offline');
})->name('laravelpwa.manifest');