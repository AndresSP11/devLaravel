@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row items-center">
            <div class="w-8/12 lg:w-6/12 p-5">
                <img src="{{asset('img/usuario.svg')}}" alt="imagen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 items-center md:items-start p-5 md:flex md:flex-col md:justify-center">
                <!-- En esta parte identifica la pate de la autorizaciòn  -->
                <p class=" text-gray-700 text-2xl">{{ $user->username}}</p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>

    <section class=" container mx-auto mt-10">
        <h2 class=" text-center text-2xl text-black font-bold my-10">Publicaciones</h2>

        @if($posts->count())

        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center gap-4">
        @foreach ($posts as $post )
            <div class=" h-96 flex justify-center">
                <a href="{{route('posts.show',['post'=>$post,'user'=>$user])}}">
                    <img src="/uploads/{{$post->imagen}}" alt="Imagen del post {{$post->titulo}}" class=" h-full">
                </a>
            </div>
        @endforeach
        </div>

        <div class=" my-10">
            {{$posts->links()}}
        </div>


        @else


        <p class=" text-gray-600 uppercase">No hay Post's</p>

        @endif
    </section>

@endsection