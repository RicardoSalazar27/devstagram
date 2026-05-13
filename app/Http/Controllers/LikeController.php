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

    public function destroy(Request $request, Post $post)
    {
        // dd('eliminando like');
        /* 
            DELETE FROM likes
            WHERE user_id = usuario_logueado
            AND post_id = post_actual;

            De los likes de Ricardo,
            borra el que sea del post 8.

            Like pertenece a un usuario y pertenece a un post. Por eso 
            puedes manejarlo desde User o desde Post, según lo que te convenga.
        */
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
