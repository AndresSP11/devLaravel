<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Actividad para generar una URL sana y tranquila */
use Illuminate\Support\Str;
use Intevention\Image\Facades\Image;
/* Es la que se ha utilizado la Interventión Image */
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    /* El procedimiento para mandar la imagen */
    /* Cuando se sube la parte de Usuario se queda almacenado aqui */
    public function store(Request $request)
    {
        /* La nueva forma de utilización de la base de datos en base a los Usuarios */

        $manager = new ImageManager(new Driver());
        
        $imagen= $request->file('file');
        /* Id bien definido para cada imagen */
        $nombreImagen=Str::uuid().".".$imagen->extension();
        
        $imagenServidor=$manager->read($imagen);

        $imagenServidor->scale(1000,1000);

        $imagenPath=public_path('uploads').'/'.$nombreImagen;

        $imagenServidor->save($imagenPath);

        /* Mandar la respuesta al Json, del nombre de la Imagen */

        return response()->json(['imagen'=>$nombreImagen]);
    }
}
