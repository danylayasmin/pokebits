<x-layout>
    <x-slot:title>
        Pokedex
    </x-slot>
    <div class="items-center h-screen">
        <div class="py-12">
            <div class="min-h-screen items-center justify-center grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 p-4">
                <?php
                // Loop through 50 times to create 50 Pikachu cards
                for ($i = 1; $i <= 50; $i++) {
                ?>
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg">
                        <div class="p-4">
                            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png" alt="Pokemon" class="mx-auto">
                            <h3 class="text-xl font-semibold text-center mt-4">Pikachu <?php echo $i; ?></h3>
                            <p class="text-sm text-gray-600 text-center mt-2">Electric type</p>
                            <p class="text-sm text-gray-600 text-center mt-2">Weight: 11kg | Height: 11m</p>
                            <p class="text-sm text-gray-600 text-center mt-2">Abilities: HERE PUT</p>
                            <p class="text-sm text-gray-600 text-center mt-2">Habitat: HERE PUT</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</x-layout>