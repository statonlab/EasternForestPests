<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\GlossaryController;
use App\Http\Controllers\PestController;
use App\Http\Controllers\PestImageController;
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
Auth::routes();

Route::group([], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', function () {
        return view('auth/login');
    });
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/{any}', function () {
        return view('home');
    })->where('any', '^(?!api|admin|web).*');
});

Route::group([
    'prefix' => 'web',
], function () {
//    Route::resource('pests', PestController::class);
    Route::get('pests', [PestController::class, 'index']);
    Route::get('pest/{pest}', [PestController::class, 'show']);
    Route::post('pests', [PestController::class, 'create']);
    Route::put('pests/{pest}', [PestController::class, 'update']);
    Route::resource('glossaries', GlossaryController::class);
    Route::resource('chapters', ChapterController::class);
    Route::post('/pests/{pest}/images', [PestImageController::class, 'store']);

});

Route::group([
    'middleware' => ['auth', 'auth.session'],
], function () {
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index']);

    Route::redirect('/', '/admin');
    Route::get('admin/{vue?}', 'HomeController@index')->name('home');
});