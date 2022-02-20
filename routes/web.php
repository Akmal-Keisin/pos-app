<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MoneyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function() {
    // Admin Crud Product
    Route::resource('/admin', ProductAdminController::class)->middleware('auth');

    // Category
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{category}', [CategoryController::class, 'show']);

    // Main
    Route::get('/', function() {
        return redirect('/home');
    });
    Route::get('/home', [MainController::class, 'index']);
    Route::get('/home/{product}', [MainController::class, 'show']);
});


// Login
Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
Route::post('/login', [AuthController::class, 'loginAuth']);
Route::post('/logout', [AuthController::class, 'logout']);

// Register
Route::get('/register', [AuthController::class, 'registerIndex']);
Route::post('/register', [AuthController::class, 'registerCreate']);

// Cart
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/{cart}', [CartController::class, 'store']);
Route::put('/cart/{cart}', [CartController::class, 'update']);
Route::delete('/cart/{cart}', [CartController::class, 'destroy']);

// Money
Route::get('/money', [MoneyController::class, 'index']);
Route::post('/money', [MoneyController::class, 'store']);

