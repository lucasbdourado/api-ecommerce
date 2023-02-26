<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware(['auth:sanctum', 'verified'])->resource('/address', AddressController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/address/user', [CategoryController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/address', [AddressController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/address/{id}', [AddressController::class, 'find']);
Route::middleware(['auth:sanctum', 'verified'])->get('/address/create', [AddressController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->post('/address', [AddressController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->get('/address/{id}/edit', [AddressController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->put('/address/{id}', [AddressController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->delete('/address/{id}', [AddressController::class, 'destroy']);

Route::get('/products', [ProductController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/products/create', [ProductController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->get('/products/{id}', [ProductController::class, 'find']);
Route::middleware(['auth:sanctum', 'verified'])->post('/products', [ProductController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->put('/products/{id}', [ProductController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->delete('/products/{id}', [ProductController::class, 'destroy']);

