<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowerController extends Controller
{
    //
    public function store(User $user)
    {   //user es el perfil que estamos visitando
        // dd($user->username);
        $user->followers()->attach( auth()->user()->id );

        return back();
    }
}
