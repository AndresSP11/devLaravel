<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $request,Post $post){
        $post->likes()->create(
            [
                'user_id'=>auth()->user()->id
            ]
        );
        return back();
    }

    public function destroy(Request $request,Post $post){
        
        /* En el post en el que me encuentro */
        $request->user()->likes()->where('post_id',$post->id)->delete();
        return back();
    }
}
