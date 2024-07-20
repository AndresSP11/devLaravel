<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        /* En este caso por defecto si no encuentra la validadicòn de inico de sesion
        el middleware lo detecta, pero si pasa pasa a la siguiente funciòn */
        /* Validar la autenticación, para ver si existe o no */
        /* Validación del middleware que permite la autenticación del usuario. */
        $this->middleware('auth');
    }
    
    /* Router build moding */
    public function index(User $user)
    {
       
        /* Aqui te enviará al muro si es que pasa primero la parte de validación del $this middleware
        Recordar tambien qeu primero  va pasr por el constructor del middleware, luego al momento de colocar view layout fasborad, es por la funciòn
        es por ello que para que muestre la parte del get se tien que tener en cuenta esto */

        /* Pasando las varaibles de sesión iniciada en la parte del Muro de la */
        return view('dashboard',[
            'user'=>$user
        ] );
        /* dd(auth()->user()); */
        /* return view('auth.register'); */

    }
    
    public function create()
    {
        /* Es quien nos retorna para poder tener la vista del formulario en esta ocasión */
        return view('posts.create');
    }

    /* Esta es para hacer la validaciónd delos posts necesarios, para luego mandarlo a la clase del controlador */
    public function store(Request $request)
    {
        /* Creando la publicación del estado , RECORAR QUE PARA VALIDACIÓN TENEMOS QUE HACERLE EN UN REGISTRO O LOGIN*/
        $this->validate($request,[
            'titulo'=>'required|max:255',
            'descripcion'=>'required',
            'imagen'=>'required'
        ]);
        /* En la parte del modelo, sirve para 
        la creación que nos brinda o tenemos esto */
        Post::create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen'=>$request->imagen,
            /* Esta es la forma que ya se encuentra identificada */
            'user_id'=>auth()->user()->id
        ]);

        return redirect()->route('posts.index',auth()->user()->username);



    }

}
