@extends('layouts.app')

@section('titulo')
Regístrate en DevsTagram
@endsection

@section('contenido')
    <div class=" md:flex md:justify-center md:gap-4 md:items-center">
        <div class=" md:w-1/2">
            <img src="{{asset('img/registrar.jpg')}}" class="shadow-md shadow-black rounded-lg" alt="">
        </div>
        <div class=" md:w-4/12 bg-white p-6 rounded-lg shadow-gray-400 shadow-lg">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class=" mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Tu Nombre"
                    class=" border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                    value="{{old('name')}}">
                    @error('name')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold">
                        UserName
                    </label>
                    <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class=" border p-3 w-full rounded-lg @error('username') border-red-500 @enderror">
                    @error('username')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Tu Email de Registro"
                    class=" border p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="password" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Tu Password de Registro"
                    class=" border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="password_confirmation" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input 
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repite tu Password"
                    class=" border p-3 w-full rounded-lg">
                    
                </div>
                <input type="submit" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                 font-bold w-full p-3 text-white rounded-lg" value="Crear Cuenta">
            </form>
        </div>
    </div>
@endsection