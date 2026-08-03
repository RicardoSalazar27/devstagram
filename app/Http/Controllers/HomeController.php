<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // throw new \Exception('Not implemented');
        $this->middleware('auth');
    }
    //
    public function __invoke()
    {
        // throw new \Exception('Not implemented');
        // dd('home');
        // return view('home');

        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);

    }
}
