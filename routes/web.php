<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProductController;

// ===== AREA ADMIN (hanya role admin) =====
Route::get('/admin/dashboard', [FinanceController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// ===== LAPORAN KEUANGAN (ADMIN) =====
Route::middleware(['auth', 'role:admin'])->prefix('admin/finance')->name('admin.finance.')->group(function () {
    Route::post('/store', [FinanceController::class, 'store'])->name('store');
    Route::get('/{report}/edit', [FinanceController::class, 'edit'])->name('edit');
    Route::put('/{report}', [FinanceController::class, 'update'])->name('update');
    Route::delete('/{report}', [FinanceController::class, 'destroy'])->name('destroy');
});

// ===== KERANJANG (CUSTOMER) =====
Route::middleware(['auth', 'role:customer'])->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::patch('/{item}', [CartController::class, 'update'])->name('update');
    Route::delete('/{item}', [CartController::class, 'destroy'])->name('destroy');
});

// ===== CHECKOUT & PESANAN (CUSTOMER) =====
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

// ===== KELOLA PESANAN (ADMIN) =====
Route::middleware(['auth', 'role:admin'])->prefix('admin/orders')->name('admin.orders.')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('index');
    Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
    Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update');
});

// ===== KELOLA PENGGUNA (ADMIN) =====
Route::middleware(['auth', 'role:admin'])->prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::patch('/{user}/toggle', [AdminUserController::class, 'toggle'])->name('toggle');
});

// ===== CRUD PRODUK (ADMIN) =====
Route::middleware(['auth', 'role:admin'])->prefix('admin/products')->name('admin.products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

// ===== FORGOT / RESET PASSWORD =====
// Nama route 'password.reset' wajib, dipakai Laravel untuk membuat link di email
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::view('/products', 'products');
Route::view('/addons', 'addons');
Route::view('/others', 'others');


// Redirect sesuai role setelah login
Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect('/catalog');
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'role:admin']);

Route::get('/contact', function () {
    return view('contact');
});

// Katalog publik sekarang mengambil data dari database, terpisah dari main page (welcome.blade.php)
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');

// Halaman Team (link navbar memakai href="team.html", jadi route-nya disamakan)
Route::view('/team.html', 'team');

