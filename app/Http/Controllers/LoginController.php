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
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            /* Si arroja falso significa que va mandar un mensajae ne la parte de atrás 
            luego con las credenciales menos */
            return back()->with('mensaje','Credenciales Incorrectas');
        }
            /* Se va al muro */
            return redirect()->route('posts.index');



    }
}
