<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        /* Hacemos las validaciones del input en este lugar, tanto como email y password */
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        /* Aqui hacemos otro tipo de validaciòn, pero ya en la base de datos */
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            /* Si arroja falso significa que va mandar un mensajae ne la parte de atrás 
            luego con las credenciales menos */
            /* Retroceder a la pestana anteriro */
            /* Back, significa para dar el mensaje, recordar que estamos mandando la variable de back
            'mensaje' para que detecte la variable */
            return back()->with('mensaje','Credenciales Incorrectas');
        }
            /* Se va al muro, pero con los valores de Usuario */
            return redirect()->route('posts.index',['user'=>auth()->user()->username]);

    }
}
