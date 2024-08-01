@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class=" md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store')}}" class=" mt-10 md:mt-0" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                    id="username"
                    name="username"
                    type="text"
                    {{-- placeholder="Tu Nombre de Usuario" NO REQUIERE PLACEHOLDER --}}
                    class=" border p-3 w-full rounded-lg {{-- @error('username') border-red-500 @enderror --}}"
                    value="{{auth()->user()->username}}">
                    @error('username')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>

                <div class=" mb-5">
                    <label for="imagen" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input 
                    id="imagen"
                    name="imagen"
                    type="file"
                    placeholder="Tu Nombre de Usuario"
                    class=" border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    value="{{auth()->user()->username}}"
                    accept=".jpg,.jpeg,.png">
                    
                </div>
                
                <input 
                type="submit" 
                class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                font-bold w-full p-3 text-white rounded-lg" 
                value="Crear Cuenta">

            </form>
        </div>
    </div>
@endsection