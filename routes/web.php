<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PestController;
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

Route::get('/adminn', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/logout', [LoginController::class,'logout']);

Route::get('/pests', [PestController::class, 'index']);
Route::get('/pests/{pest}', [PestController::class, 'show']);
Route::post('/pests', [PestController::class, 'create']);
Route::put('/pests/{pest}', [PestController::class, 'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('layouts.app');
