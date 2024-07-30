@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto md:flex">
        <div class=" md:w-1/2">
            <img src="{{asset('uploads').'/'.$post->imagen}}" alt="{{$post->titulo}}">
            
            <div>
                <p>0 Likes</p>
            </div>
        
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