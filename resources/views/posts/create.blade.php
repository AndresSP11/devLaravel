@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

@section('contenido')
    <div class=" md:flex md:items-center">
        <div class=" md:w-1/2 px-10">
            Imagen aqui
        </div>
        <div class=" md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-10 ">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="mb-5 rounded-lg shadow-xl mt-10 md:mt-0 p-4">
                    <label for="name" class=" mb-2 block uppercase font-bold">
                        Nombre
                    </label>
                    <input 
                    id="name"
                    name="titulo"
                    type="text"
                    placeholder="Tu Titulo"
                    class=" border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value="{{old('tituilo')}}">
                    @error('name')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class=" border p-3 w-full shadow-xl rounded-lg @error('username') border-red-500 @enderror">
                        {{old('titulo')}}
                    </textarea>
                    @error('username')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror

                </div>
                <input type="submit" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                 font-bold w-full p-3 text-white rounded-lg" value="Crear Publicación">
            </form>
        </div>
    </div>
@endsection