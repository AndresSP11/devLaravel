<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
/* Importando interventionImage */
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        /* Una vezz enviado el POST... emepzamos a validar aquello */
        $request->request->add(['username'=>Str::slug($request->username)]);

        
        $this->validate($request,[
            // 'username' => 'required|unique:users|min:3|max:20'
            'username'=>['required',
            'unique:users,username,'.auth()->user()->id,
            'min:3',
            'max:20',
            'not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen){
            
            $manager = new ImageManager(new Driver());
        
            $imagen= $request->file('imagen');
            /* Id bien definido para cada imagen, darle un nombre que permita dar unificado a la foto de perfil*/
            $nombreImagen=Str::uuid().".".$imagen->extension();
            
            $imagenServidor=$manager->read($imagen);
    
            $imagenServidor->scale(1000,1000);
    
            $imagenPath=public_path('perfiles').'/'.$nombreImagen;
    
            $imagenServidor->save($imagenPath);
        }

        //Guardar Cambios
        $usuario= User::find(auth()->user()->id);

        $usuario->username=$request->username;
        $usuario->imagen=$nombreImagen ?? auth()->user()->imagen ??'';

        $usuario->save();

        return redirect()->route('posts.index',$usuario->username);
    }

}
