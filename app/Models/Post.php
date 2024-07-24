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


    public function user()
    {
        /* La llave solo identifica que es lo que se le pasará a la parte de vista o que es lo que solo quiero obtener aqui */
        return $this->belongsTo(User::class)->select(['name','username']);
    }

}
