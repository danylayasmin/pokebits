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
        $request->validate([
            'pokemon' => ['required'],
            'ability' => ['required'],
        ]);

        return new PokemonAbilityResource(PokemonAbility::create($request->validated()));
    }

    public function show(PokemonAbility $pokemonAbility)
    {
        return new PokemonAbilityResource($pokemonAbility);
    }

    public function update(Request $request, PokemonAbility $pokemonAbility)
    {
        $request->validate([
            'pokemon' => ['required'],
            'ability' => ['required'],
        ]);

        $pokemonAbility->update($request->validated());

        return new PokemonAbilityResource($pokemonAbility);
    }

    public function destroy(PokemonAbility $pokemonAbility)
    {
        $pokemonAbility->delete();

        return response()->json();
    }
}
