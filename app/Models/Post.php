<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /* Información que se va llenar en la base de datos, teniendo en cuenta la tabla */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    /* La deteerminación de la parte de User */
    public function user()
    {
        /* La llave solo identifica que es lo que se le pasará a la parte de vista o que es lo que solo quiero obtener aqui */
        /* M:1 */
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios()
    {
        /*  1 post puede tener M muchos Comentarios */
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        /* eSTA TABLA DE LIKES, CONTEIEN EN LA COLUMNA DE USER ID , CONTIENE ESTE USUARIO DE ESTE pOST */
        return $this->likes->contains('user_id',$user->id);
    }
}
