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

    //revisar si un uisuario ya le dio me gusta
    public function checklike(User $user)
    {
        /*
        se situa en la relacion llamada "likes" osea en la tabla likes
        y revisa/devuelve los post que tengan el like de el user_id
        ese user_id se le pasara al llamar el metodo

        contains reviosa la tabla de likes, si contiene en la columna de user_id, contiene
        $user-> id???
        */
        return $this->likes->contains('user_id', $user->id);
    }
}
