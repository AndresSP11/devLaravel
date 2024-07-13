@extends('layouts.app')

@section('titulo')
Inicia Sesión en Devstagram
@endsection

@section('contenido')
    <div class=" md:flex md:justify-center md:gap-4 md:items-center">
        <div class=" md:w-1/2">
            <img src="{{asset('img/login.jpg')}}" class="shadow-md shadow-black rounded-lg" alt="">
        </div>
        <div class=" md:w-4/12 bg-white p-6 rounded-lg shadow-gray-400 shadow-lg">
            <form method="POST" action="{{route('login')}}" >
                @csrf
                
                @if (session('mensaje'))
                    <p class=" text-white bg-red-500 text-center mt-2 p-1 font-bold rounded-lg ">{{session('mensaje')}}</p>
                @endif
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
                    <input type="checkbox" name="remember"> <label class=" mb-2 uppercase text-gray-500 font-bold">Mantener mi sesión abierta</label> 
                </div>
                
                <input type="submit" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                 font-bold w-full p-3 text-white rounded-lg" value="Iniciar Sesión">
            </form>
        </div>
    </div>
@endsection