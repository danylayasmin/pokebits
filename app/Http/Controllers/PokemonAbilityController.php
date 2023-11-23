<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonAbilityResource;
use App\Models\PokemonAbility;
use Illuminate\Http\Request;

class PokemonAbilityController extends Controller
{
    public function index()
    {
        return PokemonAbilityResource::collection(PokemonAbility::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pokemon' => ['required'],
            'ability' => ['required'],
        ]);

        return new PokemonAbilityResource(PokemonAbility::create($validated));
    }

    public function show(PokemonAbility $pokemonAbility)
    {
        return new PokemonAbilityResource($pokemonAbility);
    }

    public function update(Request $request, PokemonAbility $pokemonAbility)
    {
        $validated = $request->validate([
            'pokemon' => ['required'],
            'ability' => ['required'],
        ]);

        $pokemonAbility->update($validated);

        return new PokemonAbilityResource($pokemonAbility);
    }

    public function destroy(PokemonAbility $pokemonAbility)
    {
        $pokemonAbility->delete();

        return response()->json();
    }
}
