<div>
    {{-- Stop trying to control. --}}
    {{-- <h1>{{ $post->titulo }}</h1> --}}
    <button wire:click="like">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
            viewBox="0 0 24 24"><!-- Icon from HeroIcons by Refactoring UI Inc - https://github.com/tailwindlabs/heroicons/blob/master/LICENSE -->
            <path fill="red" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M21 8.25c0-2.485-2.099-4.5-4.687-4.5c-1.936 0-3.598 1.126-4.313 2.733c-.715-1.607-2.377-2.733-4.312-2.733C5.098 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12" />
        </svg>
    </button>
</div>
