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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/v1/productos',App\Http\Controllers\Api\V1\ProductController::class);
Route::apiResource('/v1/tortillerias',App\Http\Controllers\Api\V1\StoreController::class);
Route::apiResource('/v1/sucursales',App\Http\Controllers\Api\V1\BranchController::class);

