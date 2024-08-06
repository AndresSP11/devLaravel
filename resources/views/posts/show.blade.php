@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto md:flex">
        <div class=" md:w-1/2">
            <img src="{{asset('uploads').'/'.$post->imagen}}" alt="{{$post->titulo}}">
            
            <div class=" p-3 flex items-center gap-4">
                @auth

                {{-- Aqui también se puede ejecutar comandos de la parte de PHP haciendo uso de esa etiquetea @php
                    
                @endphp --}}

                @php
                    $mensaje="Enviando desde etiqueta php"
                @endphp


                {{-- AQUI SE HACE LLAMADO DE LIVEWIRE --}}
                <livewire:like-post :mensaje="$mensaje"  />


                @if ($post->checkLike(auth()->user()))
                    <form action="{{route('posts.likes.destroy' ,$post)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class=" my-4">
                            <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            </button>
                        </div>
                    </form> 
                    
                @else
                    <form action="{{route('posts.likes.store' ,$post)}}" method="POST">
                        @csrf
                        <div class=" my-4">
                            <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            </button>
                        </div>
                    </form> 
                @endif
                 
                @endauth
                <p class="">{{ $post->likes->count() }}
                    <span>Likes</span></p>
           
                
            </div>
        
            {{-- En este caso --}}
            <div>
                <p class=" font-bold">{{$post->user->username}}</p>

                <p class=" text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                </p>
                <p class=" mt-5">
                    {{$post->descripcion}}
                </p>
            </div>
            {{-- En esta parte primero verificamos si esta autenticado o se ha logeado para poder hacer dicha 
            eliminaciòn de valores --}}
            @auth
                {{--Ya en este caso se va evaluar la parte del $post->user_id para ver que si la persona que posteo esto, es la persona que esta logeada con el mismo id, 
                si etas 2 coicnciden no habrà ningùn problema entonces  --}}
                {{-- @if($post->user_id==auth()->user()->id) --}}
                {{-- Aqui es la parte de la $post,  --}}
                    <form method="POST" action="{{route('posts.destroy',$post)}}">
                        @method('DELETE');
                        @csrf
                        <input 
                        type="submit"
                        value="Eliminar Publicaciòn"
                        class=" bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold
                        mt-4 cursor-pointer"
                        >
                    </form>
               {{--  @endif --}}
            @endauth
            

        </div>

        <div class="md:w-1/2 p-5">
            <div class="mb-4 bg-white p-5 shadow-md">
                {{-- Aqui va estar la expresión del validado del auth --}}
                @auth
                    
                
                <p class=" text-xl font-bold text-center mb-4"> Agrega un Nuevo Comentario</p>

                @if (@session('mensaje'))
                    <div class=" bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif

                {{-- Parametrización de datos correspondientes en forma del Post y User --}}
                <form action="{{route('comentarios.store',['post'=>$post,'user'=>$user])}}" method="POST">
                    @csrf
                    <div class=" mb-5">
                        <label for="descripcion" class=" mb-2 block uppercase text-gray-500 font-bold">
                            Añade un Comentario
                        </label>
                        <textarea 
                        id="comentario"
                        name="comentario"
                        placeholder="Agregar un Comentario"
                        class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">
                            
                        </textarea>
                        @error('comentario')
                            <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                        @enderror
                    </div>

                    <input 
                    type="submit" 
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                 font-bold w-full p-3 text-white rounded-lg" 
                    value="Comentar">        
                </form>
                @endauth

                <div class=" bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    {{-- En este caso esta haciendo uso de las funciones --}}
                    {{-- Aqui se manda el for each  --}}
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario )
                            <div class=" p-5 border-x-gray-300 border-b">
                                <a href="{{ route('posts.index',$comentario->user)}}" class=" font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{ $comentario->comentario}}</p>
                                <p class=" text-sm text-gray-500">{{ $comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class=" p-10 text-center">No hay Comentarios Aún</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection