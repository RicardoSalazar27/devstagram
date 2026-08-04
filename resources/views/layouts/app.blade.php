<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <title>Devstagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black">Devstagram</a>
            @auth
                <nav class="flex gap-2 items-center">
                <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{ route('posts.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from HeroIcons by Refactoring UI Inc - https://github.com/tailwindlabs/heroicons/blob/master/LICENSE --><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23q-.57.08-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a48 48 0 0 0-1.134-.175a2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.19 2.19 0 0 0-1.736-1.039a49 49 0 0 0-5.232 0a2.19 2.19 0 0 0-1.736 1.039z"/><path d="M16.5 12.75a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m2.25-2.25h.008v.008h-.008z"/></g></svg>
                    Crear
                </a>
                <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                    Hola: <span class="font-normal">{{ auth()->user()->username }}</span></a>
                <form type="submit" method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sesión</button>
                </form>
            </nav>
            @endauth
            @guest
                <nav class="flex gap-2 items-center">
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
            </nav>
            @endguest
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center mb-10 text-3xl">
            @yield('titulo')
        </h2>
        @yield('contenido')
    </main>
    <footer class="mt-10 text-center uppercase p-5 text-gray-500 font-bold">
        Devstagram - Todos los derechos reservados {{ now()->year }}
    </footer>
    @livewireScripts
</body>

</html>
