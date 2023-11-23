<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $pokemon = Pokemon::query()
            ->with('types')
            ->with('abilities');

        if ($request->has('name')) {
            $pokemon->where('name', $request->input('name'));
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

        $response = $pokemon->get();

        return PokemonResource::collection($response);
    }

    public function getById($id)
    {
        return new PokemonResource(Pokemon::find($id));
    }

    public function getByName($name)
    {
        return new PokemonResource(Pokemon::where('name', $name)->first());
    }

    public function store(Request $request)
    {
        $request->validate([
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

        return new PokemonResource(Pokemon::create($request->validated()));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $request->validate([
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

        $pokemon->update($request->validated());

        return new PokemonResource($pokemon);
    }

    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();

        return response()->json();
    }
}
