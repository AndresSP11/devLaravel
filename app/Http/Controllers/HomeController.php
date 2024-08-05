<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $ids=auth()->user()->followers->pluck('id')->toArray();
        /* Obtenciòn de la tabla del user_id en este caso con los ids necesarios */
        $posts=Post::whereIn('user_id',$ids)->latest()->paginate(20);

        return view('home',[
            'posts'=>$posts
        ]);


    }
}
