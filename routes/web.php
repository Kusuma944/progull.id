<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProductController;

Route::get('/admin/dashboard', [FinanceController::class, 'index'])->middleware('auth')->name('admin.dashboard');
Route::post('/admin/finance/store', [FinanceController::class, 'store'])->middleware('auth');

// ===== CRUD PRODUK (ADMIN) =====
Route::middleware('auth')->prefix('admin/products')->name('admin.products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::view('/products', 'products');
Route::view('/addons', 'addons');
Route::view('/others', 'others');


Route::get('/dashboard', function () {
    return 'LOGIN BERHASIL';
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
});

// Katalog publik sekarang mengambil data dari database, terpisah dari main page (welcome.blade.php)
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');

// Halaman Team (link navbar memakai href="team.html", jadi route-nya disamakan)
Route::view('/team.html', 'team');

