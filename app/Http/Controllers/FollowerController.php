<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class FollowerController extends Controller
{
    /* Dar seguir aqui a la base de datos */
    public function store(User $user, Request $request)
    {
        /* El user id YA TIENE EL following del user id que le dio click 
        el usuario andrea (5) ya tiene el seguimiento de usuario (1) ANDRES*/
       $user->followers()->attach( auth()->user()->id );

        return back();
        
    }

    public function destroy(User $user)
    {
        /* En este caso es el $user registrado o mandado */

        $user->followers()->detach( auth()->user()->id );

        return back();
    }
}
