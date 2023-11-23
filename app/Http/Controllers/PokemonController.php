<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonResource;
use App\Models\EncounterAreas;
use App\Models\Pokemon;
use App\Models\PokemonAbility;
use App\Models\PokemonType;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'pokemon_id' => ['required', 'integer', 'unique:pokemon'],
            'name' => ['required', 'unique:pokemon'],
            'sprite_front' => ['required'],
            'sprite_back' => ['required'],
            'artwork' => ['required'],
            'stat_hp' => ['required', 'integer'],
            'stat_attack' => ['required', 'integer'],
            'stat_defense' => ['required', 'integer'],
            'stat_special_attack' => ['required', 'integer'],
            'stat_special_defense' => ['required', 'integer'],
            'stat_speed' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
        ]);

        return new PokemonResource(Pokemon::create($validated));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $validated = $request->validate([
            'pokemon_id' => ['required', 'integer', 'unique:pokemon'],
            'name' => ['required', 'unique:pokemon'],
            'sprite_front' => ['required'],
            'sprite_back' => ['required'],
            'artwork' => ['required'],
            'stat_hp' => ['required', 'integer'],
            'stat_attack' => ['required', 'integer'],
            'stat_defense' => ['required', 'integer'],
            'stat_special_attack' => ['required', 'integer'],
            'stat_special_defense' => ['required', 'integer'],
            'stat_speed' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
        ]);

        $isInUse = false;
        if (PokemonType::where('pokemon', $pokemon->name)->exists() || PokemonAbility::where('pokemon', $pokemon->name)->exists() || EncounterAreas::where('pokemon', $pokemon->name)->exists() || Species::where('pokemon_name', $pokemon->name)->exists()){
            $isInUse = true;
        }

        if ($isInUse) {
            return errorJson('Pokemon is in use and can\'t be updated', 400);
        }

        $pokemon->update($validated);

        return new PokemonResource($pokemon);
    }

    public function destroy(Pokemon $pokemon)
    {
        $isInUse = false;
        if (PokemonType::where('pokemon', $pokemon->name)->exists() || PokemonAbility::where('pokemon', $pokemon->name)->exists() || EncounterAreas::where('pokemon', $pokemon->name)->exists() || Species::where('pokemon_name', $pokemon->name)->exists()){
            $isInUse = true;
        }
        if ($isInUse) {
            return errorJson('Pokemon is in use and can\'t be deleted', 400);
        }
        $pokemon->delete();

        return response()->json();
    }
}
