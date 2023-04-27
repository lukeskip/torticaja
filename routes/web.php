<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/slideform', function () {
    return view('test');
});

Route::get('/config', function () {
    return view('config');
});

Route::post('/test-connection', function () {
    return response()->json(['success' => true ]);
});

Route::get('/outcomes-photos/{filename}', [App\Http\Controllers\FileController::class, 'serve_file'])->name("outcomes_file");
