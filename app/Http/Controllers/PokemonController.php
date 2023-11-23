<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        return PokemonResource::collection(Pokemon::all());
    }

    public function getById($id)
    {
        $pokemon = Pokemon::find($id);
        if (!$pokemon) {
            return errorJson('Pokemon not found', 404);
        }
        return new PokemonResource($pokemon);
    }

    public function getByName($name)
    {
        $pokemon = Pokemon::where('name', $name)->get();
        if ($pokemon->isEmpty()) {
            return errorJson('Pokemon not found', 404);
        }
        return PokemonResource::collection($pokemon);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pokemon_id' => ['required', 'integer'],
            'name' => ['required'],
            'sprite_front' => ['required'],
            'sprite_back' => ['required'],
            'artwork' => ['required'],
            'stat_hp' => ['required', 'integer'],
            'stat_attack' => ['required', 'integer'],
            'stat_defense' => ['required', 'integer'],
            'stat_special_attack' => ['required', 'integer'],
            'stat_special_defense' => ['required', 'integer'],
            'stat_speed' => ['required', 'integer'],
        ]);

        return new PokemonResource(Pokemon::create($validated));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $validated = $request->validate([
            'pokemon_id' => ['required', 'integer'],
            'name' => ['required'],
            'sprite_front' => ['required'],
            'sprite_back' => ['required'],
            'artwork' => ['required'],
            'stat_hp' => ['required', 'integer'],
            'stat_attack' => ['required', 'integer'],
            'stat_defense' => ['required', 'integer'],
            'stat_special_attack' => ['required', 'integer'],
            'stat_special_defense' => ['required', 'integer'],
            'stat_speed' => ['required', 'integer'],
        ]);

        $pokemon->update($validated);

        return new PokemonResource($pokemon);
    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();

        return response()->json();
    }
}
