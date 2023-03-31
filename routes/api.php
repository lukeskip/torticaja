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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// STARTS V1 ROUTES/////////////////////////////////////////////////////////////////
Route::middleware('auth:sanctum')->get('/v1/dashboard',[App\Http\Controllers\Api\V1\DashboardController::class, 'index'])->name('dashboard'); 

Route::apiResource('/v1/incomes',App\Http\Controllers\Api\V1\IncomeController::class);
Route::apiResource('/v1/outcomes',App\Http\Controllers\Api\V1\OutcomeController::class);
Route::apiResource('/v1/orders',App\Http\Controllers\Api\V1\OrderController::class);
Route::apiResource('/v1/products',App\Http\Controllers\Api\V1\ProductController::class);
Route::apiResource('/v1/shops',App\Http\Controllers\Api\V1\StoreController::class);
Route::apiResource('/v1/branches',App\Http\Controllers\Api\V1\BranchController::class);

Route::middleware('auth:sanctum')
    ->get('/v1/orders',[App\Http\Controllers\Api\V1\OrderController::class, 'create'])
    ->name('order-create'); 

// ENDS V1 ROUTES/////////////////////////////////////////////////////////////////

