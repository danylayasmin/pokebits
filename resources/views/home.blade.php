<x-layout>
    <x-slot:title>
        Pokedex
    </x-slot>
    <div class="items-center h-screen">
        <div class="py-12">
            <div
                class="min-h-screen items-center justify-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 p-4">
                @foreach ($data as $i => $poke)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg">
                        <div class="p-4">
                            <img src="https://cdn.statically.io/img/raw.githubusercontent.com/w=128,f=auto/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{{ $poke->pokemon_id }}.png"
                                 loading="{{ $i < 15 ? 'eager' : 'lazy' }}" alt="Pokemon" class="mx-auto w-32"
                                onerror="this.onerror=null; this.src='https://s6.imgcdn.dev/Rmgjd.png';">
                            <h3 class="text-xl font-semibold text-center mt-4 capitalize">{{ $poke->name }}</h3>
                            <p class="text-sm text-gray-600 text-center mt-2">Types:  @foreach ($poke->types as $key => $type)
                                <span class="text-sm text-gray-600 text-center mt-2 inline-block capitalize">{{ $type->name }}</span>
                                @if ($key < count($poke->types) - 1)
                                    @if ($key === count($poke->types) - 2)
                                        <span class="text-sm text-gray-600 text-center mt-2 inline-block"> & </span>
                                    @endif
                                @endif
                            @endforeach</p>
                            <p class="text-sm text-gray-600 text-center mt-2">Weight: {{ $poke->weight / 100 }} kg • Height: {{ $poke->height / 10 }} m</p>
                            <p class="text-sm text-gray-600 text-center mt-2">Abilities: @foreach ($poke->abilities as $key => $ability)
                                <span class="text-sm text-gray-600 text-center mt-2 inline-block capitalize">{{ $ability->name }}</span>
                                @if ($key < count($poke->abilities) - 1)
                                    @if ($key === count($poke->abilities) - 2)
                                        <span class="text-sm text-gray-600 text-center mt-2 inline-block"> & </span>
                                    @endif
                                @endif
                            @endforeach</p>
                            <p class="text-sm text-gray-600 text-center mt-2">Habitat: @if ($poke->habitat)
                                <span class="text-sm text-gray-600 text-center mt-2 inline-block capitalize">{{ $poke->habitat->name }}</span>
                            @else
                                <span class="text-sm text-gray-600 text-center mt-2 inline-block capitalize">Unknown</span>
                            @endif</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
