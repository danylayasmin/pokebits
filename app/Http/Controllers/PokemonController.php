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
    public function index(Request $request)
    {
        $pokemon = Pokemon::query()
            ->with('types')
            ->with('abilities')
            ->with('species')
            ->with('encounters')
            ->with('habitat');

        if ($request->has('hp')) {
            $pokemon->where('stat_hp', $request->input('hp'));
        }

        if ($request->has('attack')) {
            $pokemon->where('stat_attack', $request->input('attack'));
        }

        if ($request->has('defense')) {
            $pokemon->where('stat_defense', $request->input('defense'));
        }

        if ($request->has('special_attack')) {
            $pokemon->where('stat_special_attack', $request->input('special_attack'));
        }

        if ($request->has('special_defense')) {
            $pokemon->where('stat_special_defense', $request->input('special_defense'));
        }

        if ($request->has('speed')) {
            $pokemon->where('stat_speed', $request->input('speed'));
        }

        if ($request->has('height')) {
            $pokemon->where('generation', $request->input('generation'));
        }

        if ($request->has('weight')) {
            $pokemon->where('generation', $request->input('generation'));
        }

        if ($request->has('type')) {
            $pokemon->whereHas('types', function ($query) use ($request) {
                $query->where('name', $request->input('type'));
            });
        }

        if ($request->has('ability')) {
            $pokemon->whereHas('abilities', function ($query) use ($request) {
                $query->where('name', $request->input('ability'));
            });
        }

        if ($request->has('encounter')) {
            $pokemon->whereHas('encounters', function ($query) use ($request) {
                $query->where('area_name', $request->input('encounter'));
            });
        }

        if ($request->has('habitat')) {
            $pokemon->whereHas('habitat', function ($query) use ($request) {
                $query->where('name', $request->input('habitat'));
            });
        }

        if ($request->has('sort')) {
            $pokemon->orderBy($request->input('sort'));
        }

        $response = $pokemon->get();

        return PokemonResource::collection($response);
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
            'pokemon_id' => ['required', 'integer', 'unique:pokemon,pokemon_id'],
            'name' => ['required', 'unique:pokemon,name'],
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
        if (PokemonType::where('pokemon', $pokemon->name)->exists() || PokemonAbility::where('pokemon', $pokemon->name)->exists()| Species::where('pokemon_name', $pokemon->name)->exists()){
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
        if (PokemonType::where('pokemon', $pokemon->name)->exists() || PokemonAbility::where('pokemon', $pokemon->name)->exists() || Species::where('pokemon_name', $pokemon->name)->exists()){
            $isInUse = true;
        }
        if ($isInUse) {
            return errorJson('Pokemon is in use and can\'t be deleted', 400);
        }
        $pokemon->delete();

        return response()->json();
    }
}
