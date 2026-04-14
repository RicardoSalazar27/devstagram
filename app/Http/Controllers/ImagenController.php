<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        // return "desde imagen controller";
        // $input = $request->all();
        
        // return response()->json($input);

        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        /*
        Comprobamos que estamos obteniendo bien la imagen
        return response()->json(['imagen' => $imagen->extension() ]);
        */

        return response()->json(['imagen' => $nombreImagen ]);
    }
}
