<?php

use App\Http\Controllers\CartApiController;
use App\Http\Controllers\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Product CRUD
Route::get('/product', [ProductApiController::class, 'index']);
Route::get('/product/{product}', [ProductApiController::class, 'show']);
Route::post('/product', [ProductApiController::class, 'store']);
Route::put('/product/{product}', [ProductApiController::class, 'update']);
Route::delete('/product/{product}', [ProductApiController::class, 'destroy']);

// Cart
Route::get('/cart', [CartApiController::class, 'index']);
Route::post('/cart', [CartApiController::class, 'store']);
Route::put('/cart/{id}', [CartApiController::class, 'update']);
Route::get('/cart/{id}', [CartApiController::class, 'show']);
Route::delete('/cart/{id}', [CartApiController::class, 'destroy']);

// Transaction
