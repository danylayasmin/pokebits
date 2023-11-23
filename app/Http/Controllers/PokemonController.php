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
            ->with('abilities')
            ->with('species')
            ->with('encounters')
            ->with('evolution_chain')
            ->with('habitat');

        if ($request->has('name')) {
            $pokemon->where('name', $request->input('name'));
        }

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

        if ($request->has('species')) {
            $pokemon->whereHas('species', function ($query) use ($request) {
                $query->where('name', $request->input('species'));
            });
        }

        if ($request->has('encounter')) {
            $pokemon->whereHas('encounters', function ($query) use ($request) {
                $query->where('name', $request->input('encounter'));
            });
        }

        if ($request->has('evolution_chain')) {
            $pokemon->whereHas('evolution_chain', function ($query) use ($request) {
                $query->where('name', $request->input('evolution_chain'));
            });
        }

        if ($request->has('habitat')) {
            $pokemon->whereHas('habitat', function ($query) use ($request) {
                $query->where('name', $request->input('habitat'));
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
