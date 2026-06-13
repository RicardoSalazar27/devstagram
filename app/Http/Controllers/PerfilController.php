<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        // throw new \Exception('Not implemented');
        $this->middleware('auth');
    }
    //
    public function index(){
        // dd('aqui se muestra el formulario');
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        /*Slug lo que hace es convertir el texto a un formato amigable para las URL, por ejemplo, si el username es 
        "Juan Pérez", el slug sería "juan-perez". Esto se logra reemplazando los espacios por guiones y convirtiendo
        todo a minúsculas.*/
        $request->request->add(['username' => Str::slug($request->username)]);
        // dd('Guardando cambios...');
        $this->validate($request, [
            // 'username' => 'required|unique:users|min:3|max:30'
            //not in hace que no sean validad ciertas palabras y tiene su variable para obligar a guardar solo lo
            //permitido, como una lista blanca, not in es una lista negra "in:valor_permitodo"
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:30', 'not_in:twitter,editar-perfil']
        ]);

        if($request->imagen){
            // dd('si hay imagen');
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }

            $imagenServidor = Image::read($imagen);
            $imagenServidor->cover(1000, 1000);
            $imagenServidor->save(public_path('perfiles/' . $nombreImagen));
        }

        //Guardar Cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
