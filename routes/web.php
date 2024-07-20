<?php

use App\Http\Controllers\ImagenController;
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


/* Para que pase a la parte de /muro tener en cuenta que va pasar por el metodo get que es el constructor, osea el index */
/* Dentro de las llaves van objetos en base al Modelo planteado en los Modelos anteriores. */
/* En este caso recordar a la funciòn que apunta desde el controlador estarà esperando una forma de que 
se le pase el modelo a la funciòn determinada */
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');

Route::post('/posts',[PostController::class,'store'])->name('posts.store');


/* La parte de la Imagen Controller */

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');