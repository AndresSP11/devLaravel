@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection



@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class=" md:flex md:items-center">
        <div class=" md:w-1/2 px-10">
            {{-- Creando el formulació para la zona del dropzone, luego hacer uso de la libreria de javaScript --}}
            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone"
            class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col
            justify-center items-center">
                @csrf
            </form>
        </div>
        <div class=" md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-10 ">
            <form action="{{route('posts.store')}}" method="POST">
                @csrf
                <div class="mb-5 rounded-lg shadow-xl mt-10 md:mt-0 ">
                    <label for="name" class=" mb-2 block uppercase font-bold">
                        Nombre
                    </label>
                    <input 
                    id="titulo"
                    name="titulo"
                    type="text"
                    placeholder="Tu Titulo"
                    class=" border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value="{{old('titulo')}}">
                    @error('titulo')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="descripcion" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea 
                    id="descripcion"
                    name="descripcion"
                    placeholder="Descripción de la Publicación"
                    class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">
                        {{old('descripcion')}}
                    </textarea>
                    @error('descripcion')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror

                </div>
                {{-- AQUI ESTA EL INPUT --}}
                <div class=" mb-5">
                    <input
                        name="imagen"
                        type="hidden"
                    >
                    @error('imagen')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                 </div>
                 
                <input type="submit" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                 font-bold w-full p-3 text-white rounded-lg" value="Crear Publicación">                 
            </form>
        </div>
    </div>
@endsection