<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $mensaje;
    public $post;
    
    /* Aqui se recibe automaticamente la funciòn de like por parte de la carpeta livewire, en este caso en react
    recordar qeu es necesario la creaciòn de APIS, pero en liveWire lo hace de forma directa sin necesidad de crear , y hace llamado
    a la funciòn seleccionada */
    public function like(){
        return "Desde la funcion de Likes";
    }

    public function render()
    {
        
        return view('livewire.like-post');
    }
}
