<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    //
    public function index(User $user)
    {
        // dd($user->username);

        // $posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->paginate(20);
        // dd($posts);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
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

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        //Otra forma de crear un registro
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Guardando usando relaciones de eloquent
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    
    /* 
    Mostrar la publicacion un poco mas grande en el muro del usuarios al seleccioanrla
    
    primero se pasa user, la vista la manda, pero el metodo la cacha ya que la necesita en 
    web.php para crear la ruta usando el username del usuario
    */
    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        //
        // dd('elimnando...', $post->id);
        // if($post->user_id === auth()->user()->id){
        //     dd('la persona autenticada es la misma que esta intentando borrar el post');
        // }else{
        //     dd('la persona autenticada NO es la misma que esta intentando borrar el post');
        // }
        $this->authorize('delete', $post);
        $post->delete();//metodo de eloquent

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        //SI elimina, redirije al muro del usuario autentificado,
        // Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
