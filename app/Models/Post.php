<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Uu post pertenece a un usuario
    public function user()
    {
        //relacion donde un post pertenece a un usuario
        // return $this->belongsTo(User::class);

        //solo traemos la informacion necesaria
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
}
