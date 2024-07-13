<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function store()
    {
        /* La forma en la de cerrar sesión */
        auth()->logout();

        return redirect()->route('login');
    }
}
