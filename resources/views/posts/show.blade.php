@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto flex">
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
        </div>

        <div class="md:w-1/2 p-5">
            <div class="mb-4 bg-white p-5 shadow-md">

                @auth
                    
                
                <p class=" text-xl font-bold text-center mb-4"> Agrega un Nuevo Comentario</p>

                <form action="">
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
            </div>
        </div>

    </div>
@endsection