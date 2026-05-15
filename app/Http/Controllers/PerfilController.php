<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
