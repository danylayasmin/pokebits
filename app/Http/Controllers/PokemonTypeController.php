<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonTypeResource;
use App\Models\PokemonType;
use Illuminate\Http\Request;

class PokemonTypeController extends Controller
{
    public function index()
    {
        return PokemonTypeResource::collection(PokemonType::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'pokemon' => ['required'],
            'type' => ['required'],
        ]);

        return new PokemonTypeResource(PokemonType::create($request->validated()));
    }

    public function show(PokemonType $pokemonType)
    {
        return new PokemonTypeResource($pokemonType);
    }

    public function update(Request $request, PokemonType $pokemonType)
    {
        $request->validate([
            'pokemon' => ['required'],
            'type' => ['required'],
        ]);

        $pokemonType->update($request->validated());

        return new PokemonTypeResource($pokemonType);
    }

    public function destroy(PokemonType $pokemonType)
    {
        $pokemonType->delete();

        return response()->json();
    }
}
