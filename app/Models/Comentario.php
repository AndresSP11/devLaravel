<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    //Creación de la parte para imprimir un mensaje
    protected $fillable=[
        'user_id',
        'post_id',
        'comentario'
    ];

    public function user()
    {
        /* Cada comentario tiene multiples Usuarios Definidos en este caso */
        return $this->belongsTo(User::class);
    }
}
