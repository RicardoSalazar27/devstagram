@extends('layouts.app')

@section('titulo')
    {{ $post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3">
                <p>0 likes</p>
            </div>

            <div>
                {{-- en el modelo de post, definimos la relacion con userm ya que un post puede tener un usuario, por lo tanto, podemos acceder al usuario del post y mostrar su usernname. --}}
                <p class="font-bold">{{ $post->user->username }}</p>
                {{-- diffForHumans() es un metodo de carbon que nos permite mostrar la fecha de una manera mas amigable, por ejemplo, hace 2 horas, hace 3 dias, etc. --}}
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion}}</p>
            </div>
            
            @auth
                @if ($post->user_id === auth()->user()->id)
                    {{-- Elimina solo la publicacion si la persona que creo la publicacion es la misma que esta autentificada --}}
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE') {{--los navegadores no soportan el metodo DELETE en los formularios, por lo tanto, se utiliza este metodo para simularlo metodo spoofing --}}
                        <input 
                            type="submit"
                            value="Eliminar publicacion"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        >
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user] ) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold" for="descripcion">añade un comentario</label>
                            <textarea 
                                id="comentario" 
                                name="comentario"
                                placeholder="Agrega un comentarioi" 
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500    
                                @enderror "
                            ></textarea> 
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror 
                        </div>
                            <input 
                            type="submit" 
                            value="Comentar" 
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                        >
                    </form>
                @endauth
                {{-- Aqui si pueden visualizar los comentarios de una publicacion, ya sea que este autentifaca la persona que mira el perfil o no --}}
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    {{-- {{ dd($post->comentarios) }} --}}
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 boder-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold" >
                                    {{ $comentario->user->username }}
                                </a>
                                {{-- variable que se pasa/nombre de relacion/nombre del campo que se quiere mostrar, en este caso el username del usuario que hizo el comentario --}}
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-gray-500 text-sm" >{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection