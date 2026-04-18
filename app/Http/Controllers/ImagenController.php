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

        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0755, true);
        }

        $imagenServidor = Image::read($imagen);
        $imagenServidor->cover(1000, 1000);
        $imagenServidor->save(public_path('uploads/' . $nombreImagen));

        return response()->json([
            'imagen' => $nombreImagen
        ]);
    }
}