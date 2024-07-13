<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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
    return view('principal');
});
/* Recordar la clase creada en RegisterController:class, se va pasar el meetodo que se ha planteado si es index o compra etc. */
Route::get('/crear-cuenta', [RegisterController::class,'index']);
Route::post('/crear-cuenta', [RegisterController::class,'store'])->name('register');


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/muro',[PostController::class,'index'])->name('posts.index');