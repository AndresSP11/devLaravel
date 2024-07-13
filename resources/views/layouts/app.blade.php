<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Este asset esta haciendo dirección a la parte de la carpeta public --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Devstagram - @yield('titulo')</title>
    <script src="{{asset('js/app.js')}}"></script>
    @vite('resources/css/app.css')
</head>
<body class=" bg-gray-100">
    <header class=" p-5 border-b bg-white shadow">

        <div class="container mx-auto flex justify-between items-center">
            
            <h1 class=" text-3xl font-black">
                DevStagram
            </h1>

            @if (auth()->user())
                <nav class=" flex items-center gap-2">
                <a href="{{route('login')}}" class=" font-bold text-gray-600 hover:text-indigo-600 text-sm items-center">
                    Hola: <span class=" font-normal">{{ auth()->user()->username }}</span>
                </a>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="font-bold uppercase">
                        Cerrar Sesión
                    </button>
                </form>
             </nav>
            @else
                <nav class=" flex items-center gap-2">
                    <a href="{{route('login')}}" class=" font-bold uppercase text-gray-600 hover:text-indigo-600 text-sm items-center">
                        Login
                    </a>
                    <a href="{{route('register')}}" class=" font-bold uppercase text-gray-600 hover:text-indigo-600 text-sm items-center">
                        Crear Cuenta
                    </a>
                 </nav>
            @endif

            
        
        </div>
    </header>

    <main class=" container mt-10 mx-auto">
        <h2 class=" mb-10 text-3xl font-black text-center">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>

    <footer class=" mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Devstagram - Todos los derechos reservados {{now()->year}}
    </footer>
</body>
</html>
