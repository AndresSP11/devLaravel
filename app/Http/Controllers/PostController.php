<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        /* Validar la autenticación, para ver si existe o no */
        $this->middleware('auth');
    }
    

    public function index()
    {
        /* Aqui te enviará al muro si es que pasa primero la parte de validación del $this middleware */
        return view('layouts.dashboard');
        /* dd(auth()->user()); */
        /* return view('auth.register'); */

    }
}
