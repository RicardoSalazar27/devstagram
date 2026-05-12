<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request, Post $post)
    {
        // dd('dando amooor.....');

        //cual es el post
        // dd($post->id);

        // Quien esta haciendo la petición
        // dd($request->user()->id);

        //créame un like RELACIONADO a este post
        // internamente agrega 'post_id' => $post->id
        // Like::create([
        //     'user_id' => 10,
        //     'post_id' => 5
        // ]);
        //vas a usar el post actual, para insertar en la tabla de likes
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }
}
