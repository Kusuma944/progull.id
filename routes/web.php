<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinanceController;

Route::get('/admin/dashboard', [FinanceController::class, 'index'])->middleware('auth');
Route::post('/admin/finance/store', [FinanceController::class, 'store'])->middleware('auth');


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
})->middleware('auth')->name('admin.dashboard');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/catalog', function () {
    return view('catalog');
});


