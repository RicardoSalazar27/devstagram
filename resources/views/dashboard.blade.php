@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}   
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                        {{-- Si el usuario del perfil es igual al usuario autentficado, mostramos el enlace para editar el perfil, si no pues no --}}
                        @if($user->id === auth()->user()->id)
                            <a class="text-gray-500 hover:text-gray-600 cursor-pointer" href="{{ route('perfil.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from HeroIcons by Refactoring UI Inc - https://github.com/tailwindlabs/heroicons/blob/master/LICENSE --><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8l.8-2.685a4.5 4.5 0 0 1 1.13-1.897zm0 0L19.5 7.125"/></svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count(); }}
                    <span class="font-normal">Posts</span>
                </p>
                @auth
                    {{-- EL usuario actual/el del dashboard es diferente al autenticado? --}}
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo( auth()->user() ))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">                    
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de Seguir">                    
                            </form>
                        @endif  
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        {{-- por medio de un for each recorremos las publicaciones/post del usuario, que mandamos
        desde el controlador, mostrando cada imagen del post y cada imagen con un enlace.
        si no hay post, mostramos un mensjae de que no hay post --}}
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo}} ">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{-- aqui van los enlaces de paginacion --}}
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts.</p>
        @endif
    </section>
@endsection