<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $mensaje;
    public $post;
    public $isLiked;
    public $likes;


    public function mount($post){
        $this->isLiked=$post->checkLike(auth()->user());
        $this->likes=$post->likes->count();
    }
    /* Aqui se recibe automaticamente la funciòn de like por parte de la carpeta livewire, en este caso en react
    recordar qeu es necesario la creaciòn de APIS, pero en liveWire lo hace de forma directa sin necesidad de crear , y hace llamado
    a la funciòn seleccionada */
    public function like(){
        if($this->post->checkLike(auth()->user())){
            $this->post->likes()->where('post_id',$this->post->id)->delete();
            $this->isLiked=false;
            $this->likes--;
        }else{
            $this->post->likes()->create([
                'user_id'=>auth()->user()->id
            ]);
            $this->isLiked=true;
            $this->likes++;
        }
    }

    public function render()
    {
        
        return view('livewire.like-post');
    }
}
