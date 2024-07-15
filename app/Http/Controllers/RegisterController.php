<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Nette\Utils\Strings;

class RegisterController extends Controller
{
    /* Para el metodo GET */
    public function index()
    {
        return view('auth.register');
    }
    /* Para el metodo POST */
    public function store(Request $request)
    {
        /* Las validaciones y errores lo tiene almacenado ahí, solo va seguri el flujo, validaciones para 
        el usuario en la parte del form Register */
        $this->validate($request,[
            'name'=>'required|max:30',
            'username'=>'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            /* El confirmed verifica que tenga la misma confirmación del password */
            'password'=>'required|confirmed|min:6',
        ]);
        //Haciendo uso del Modelo, aqui estamos teniendo contacto del modelo y de la base de datos para almacenar
        User::create([
            'name'=>$request->name,
            'username'=>Str::slug($request->username),
            'email'=>$request->email,
            /* Colocar hash al password */
            'password'=>Hash::make($request->password) 
        ]
        );
        //Primero va crear, luego en el auth va verificar en la base de datos si existe los parametros utilizados en base a la base de datos 
        //proporcionado

        //Autenticar un Usuario
        /* auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]); */

        //Otra forma de autenticar,autenticación de usuario, esto servirá para tener un futuro de 
        //que la autenticación de Usuario se base en un futuro para este...

        auth()->attempt($request->only('email','password'));

        /* El post que se esta mandando es parte de la variable de registro, porque debido  
        ello hay veces que no lo reconoce */
        return redirect()->route('posts.index',['user'=>auth()->user()->username]);
    
    }
}
