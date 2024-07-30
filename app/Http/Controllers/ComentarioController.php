<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    
    public function store(Request $request,User $user,Post $post){
        
        //Validar
       /* Observamos que el Post, el User y el Request son distintos,
       la parte del psot es la consulta ya hecha ala base de datos, lap arte del User es el usuario autenticaodo, 
       la parte del Request, es la obtenciòn de la respuesta del formulario brindado que estamos mandando */
        $this->validate($request,[
            'comentario'=>'required|max:255'
        ]);
        
        //Almacenaar el resultado
        Comentario::create([
            'user_id'=>auth()->user()->id,
            'post_id'=>$post->id,
            'comentario'=>$request->comentario
        ]);
        //Imprimir un mensaje
        return back()->with('mensaje','Comentario Realizado Correctamente');
    }
}
