<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(User $user)
    {
        // dd($user->username);
        return view('dashboard', [
            'user' => $user
        ]);
    }

    //Permite mostrar el fomulario
    public function create()
    {
        // dd("creando post....");
        // return view('dashboard', [
        //     'user' => $user
        // ]);
        return view('posts.create');
    }
    // Recibe la informacion del formulario, valida y manda a la base de datos
    public function store(Request $request){
        // dd('Creando publicacion...');
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
