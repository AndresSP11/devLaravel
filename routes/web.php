<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
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


//Rutas para el Perfil
/* Ruteando para la parte de PerfilController */
Route::get('/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');

Route::post('/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');

Route::post('/posts',[PostController::class,'store'])->name('posts.store');
/* Para que pase a la parte de /muro tener en cuenta que va pasar por el metodo get que es el constructor, osea el index */
/* Dentro de las llaves van objetos en base al Modelo planteado en los Modelos anteriores. */
/* En este caso recordar a la funciòn que apunta desde el controlador estarà esperando una forma de que 
se le pase el modelo a la funciòn determinada */
/* Mandando la variable de user:Username , es necesario madnar la variable para indefntifcar al usuario */

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');


/* Por defecto aqui detecta que ese post se tomará el id,  */                                                                                                                                           
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');


/* Aqui es la parte del Delete , para eliminar una publicaciòn */
/* Estas mandando un post, entonces significa que este post se va mandar o una varaible indicada */
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
/*  */

Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');
/* La parte de la Imagen Controller */

/* Aqui se esta enviando a la imagnes */

Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');

//Like a las fotos 

Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');

//Eliminación de un Registro
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');

Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

//Siguiendo a Usuarios

Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');
