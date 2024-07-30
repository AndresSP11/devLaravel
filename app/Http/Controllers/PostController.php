<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /* Antes de que pase a cualquiera pasara por el middleware */
    public function __construct()
    {
        /* En este caso por defecto si no encuentra la validadicòn de inico de sesion
        el middleware lo detecta, pero si pasa pasa a la siguiente funciòn */
        /* Validar la autenticación, para ver si existe o no */
        /* Validación del middleware que permite la autenticación del usuario. */

        /* La palabra except es para mostrar algunso sin necesidad de tener el middlewaare */
        $this->middleware('auth')->except(['show','index']);
    }
    
    /* Router build moding */
    public function index(User $user)
    {
        
        /* Aqui te enviará al muro si es que pasa primero la parte de validación del $this middleware
        Recordar tambien qeu primero  va pasr por el constructor del middleware, luego al momento de colocar view layout fasborad, es por la funciòn
        es por ello que para que muestre la parte del get se tien que tener en cuenta esto */

        /* Haciendo uso de la palabra clave Where en la parte de la Interfaz */

        $posts=Post::where('user_id',$user->id)->paginate(20);

        /* Pasando las varaibles de sesión iniciada en la parte del Muro de la */
        /* Recordar que esto es para pasar la vista hacia los Usuarios correspondientes */
        return view('dashboard',[
            'user'=>$user,
            'posts'=>$posts
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
            /* 'imagen'=>'required' */
        ]);
        /* En la parte del modelo, sirve para 
        la creación que nos brinda o tenemos esto */
        //Post::create([
            //'titulo'=>$request->titulo,
            //'descripcion'=>$request->descripcion,
            //'imagen'=>$request->imagen,
            /* Esta es la forma que ya se encuentra identificada, es como la variable 
            global SESSION */
            //'user_id'=>auth()->user()->id
        //]);
        /* Haciendo uso de la parte de la funcion de uno a muchos, tambien se puede hacer el de arriba pero en este caso se ta haciendo uso de la otr funcion */
        $request->user()->posts()->create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen'=>$request->imagen,
            'user_id'=>auth()->user()->id
        ]);
        /* AQUI SE ESTA HACIENDO LA PARTE DEL RUTEO PERO MANDANDO LA AUTORIZACIÓN DEL USER */
        return redirect()->route('posts.index',auth()->user()->username);



    }
/* Mandando las variables a la parte de la vista */

    public function show(User $user,Post $post)
    {
        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }
    

    /*  */
    public function destroy(Post $post)
    {    
        /* if($post->user_id===auth()->user()->id){
            
        } */
        /* En esta parte se va brindar la autorizaciòn del codigo, en base a lo escrito y determinado
        por la parte de destroy */
        /* dd($post); */
        /* Aqui estas indicando la autorizaciòn, tambièn la parte del post, o el Requiere no que estabamos mandando */
        $this->authorize('delete',$post);
        $post->delete();
        /* Haciendo referencia a la dirección del post */
        $imagen_path=public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        /* Mandando la parte del usuario */
        return redirect()->route('posts.index',auth()->user()->username); 
    }



}
