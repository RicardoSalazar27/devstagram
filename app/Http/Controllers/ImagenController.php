<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        // Aquí va decode(), no make() ni read()
        $imagenServidor = Image::decode($imagen);

        // Redimensionar / recortar
        $imagenServidor->cover(1000, 1000);

        // Ruta destino
        $imagenPath = public_path('uploads/' . $nombreImagen);

        // Guardar
        $imagenServidor->save($imagenPath);

        return response()->json([
            'imagen' => $nombreImagen
        ]);
    }
}