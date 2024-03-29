<?php

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

Route::post('v1/login','App\Http\Controllers\Api\V1\LoginController@login')->name('login-api');
Route::post('v1/auth/register', 'App\Http\Controllers\Api\V1\AuthController@createUser')->name('register-api');





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// STARTS V1 ROUTES/////////////////////////////////////////////////////////////////
Route::middleware(['auth:sanctum','employee'])->group(function() {
    Route::get('/v1/dashboard',[App\Http\Controllers\Api\V1\DashboardController::class, 'index'])->name('dashboard'); 

    Route::middleware('auth:sanctum')->apiResource('/v1/incomes',App\Http\Controllers\Api\V1\IncomeController::class);
    Route::middleware('auth:sanctum')->apiResource('/v1/outcomes',App\Http\Controllers\Api\V1\OutcomeController::class);
    Route::middleware('auth:sanctum')->apiResource('/v1/orders',App\Http\Controllers\Api\V1\OrderController::class);
    Route::middleware('auth:sanctum')->apiResource('/v1/products',App\Http\Controllers\Api\V1\ProductController::class);
    Route::middleware('auth:sanctum')->apiResource('/v1/stores',App\Http\Controllers\Api\V1\StoreController::class);
    Route::middleware('auth:sanctum')->apiResource('/v1/branches',App\Http\Controllers\Api\V1\BranchController::class);
    Route::middleware('auth:sanctum')->apiResource('/v1/cash-closings',App\Http\Controllers\Api\V1\CashClosingController::class);

    Route::middleware('auth:sanctum')
        ->get('/v1/orders/create',[App\Http\Controllers\Api\V1\OrderController::class, 'create'])
        ->name('order-create'); 

    Route::middleware('auth:sanctum')->get('v1/product-search/{branch}/{code}','App\Http\Controllers\Api\V1\ProductController@search')->name('search-product');
});

// ENDS V1 ROUTES/////////////////////////////////////////////////////////////////

