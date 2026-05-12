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

        /*
        lA DIFERENCIA ENTRE hasOne y este, es que hasOne es tener
        aqui un post no tiene un usuario

        LO CORRECTO ES, una publicacion PERTENECE a un usuario

        belongsTo es el counter de hasOne
        */
        //solo traemos la informacion necesaria
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    // Un post puede tener multiples comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    // Otra relacion
    // UN post puede tener multiples likes
    // esta relacion trabaja sobre el modelo de LIKE
    // eso le hace saber a laravel que va a trabajar sobre la tabla de ese modelo
    // osea sobre la tabla de "likes"
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
