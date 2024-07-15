<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        /* En este caso por defecto si no encuentra la validadicòn de inico de sesion
        el middleware lo detecta, pero si pasa pasa a la siguiente funciòn */
        /* Validar la autenticación, para ver si existe o no */
        $this->middleware('auth');
    }
    
    /* Router build moding */
    public function index(User $user)
    {
       
        /* Aqui te enviará al muro si es que pasa primero la parte de validación del $this middleware
        Recordar tambien qeu primero  va pasr por el constructor del middleware, luego al momento de colocar view layout fasborad, es por la funciòn
        es por ello que para que muestre la parte del get se tien que tener en cuenta esto */

        /* Pasando las varaibles de sesión iniciada en la parte del Muro */


        return view('layouts.dashboard',[
            'user'=>$user
        ] );
        /* dd(auth()->user()); */
        /* return view('auth.register'); */

    }

    public function create()
    {

        
        return view('posts.create');
    }
}
