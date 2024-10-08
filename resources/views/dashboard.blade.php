@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row items-center">
            <div class="w-8/12 lg:w-6/12 p-5 rounded-3xl">
                <img src="{{ $user->imagen ? asset('perfiles'.'/'.$user->imagen) : asset('img/usuario.svg')}}" alt="imagen usuario" class=" rounded-full shadow-lg shadow-blue-300">
            </div>
            <div class="md:w-8/12 lg:w-6/12 items-center md:items-start p-5 md:flex md:flex-col md:justify-center">
                <!-- En esta parte identifica la pate de la autorizaciòn  -->
                <div class=" flex items-center">
                    <p class=" text-gray-700 text-2xl">{{ $user->username}}</p>

                @auth
                {{-- Si el perfil actual es el perfil que esta autenticado , entonces se motrarrá --}}
                    @if ($user->id===auth()->user()->id)
                        <a href="{{route('perfil.index')}}" class=" text-gray-500 hover:text-gray-800 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>  
                        </a>
                    @endif
                @endauth
                </div>


                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followers()->count() }}
                    {{-- Choice permite la parte de configuración o dar par o impar la palabra dependiendo la cantidad --}}
                    <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers()->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followings()->count() }}
                    {{-- Choice permite la parte de configuración o dar par o impar la palabra dependiendo la cantidad --}}
                    <span class="font-normal">@choice('Seguidos|Siguiendo',$user->followings()->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count()}}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                    {{-- En este caso si el usuario que aparece es distinto al que  esta logeado entonces si aparece el Formulario --}}
                    @if ($user->id !== auth()->user()->id)
                        
                        @if( !$user->siguiendo(auth()->user()))
                            <form 
                            action="{{ route('users.follow',$user) }}"
                            method="POST"
                            >
                            @csrf
                                <input 
                                type="submit"
                                class=" bg-blue-600 text-white uppercase rounded-lg px-3 py-1 *:text-xs font-bold cursor-pointer"
                                value="Seguir Cuenta">
                            </form>
                            @else
                            <form 
                            action="{{route('users.unfollow',$user)}}"
                            method="POST"
                            >
                            @csrf
                            @method('DELETE')
                                <input 
                                type="submit"
                                class=" mt-2 bg-red-600 text-white uppercase rounded-lg px-3 py-1 *:text-xs font-bold cursor-pointer"
                                value="Dejar de Seguir">
                            </form>
                        @endif
                    @endif
                @endauth
                




            </div>
        </div>
    </div>

    <section class=" container mx-auto mt-10">
        <h2 class=" text-center text-2xl text-black font-bold my-10">Publicaciones</h2>

        <x-listar-post :posts="$posts"/>
    </section>

@endsection