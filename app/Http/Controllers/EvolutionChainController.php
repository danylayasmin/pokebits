<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvolutionChainResource;
use App\Models\EvolutionChain;
use Illuminate\Http\Request;

class EvolutionChainController extends Controller
{
    public function index()
    {
        return EvolutionChainResource::collection(EvolutionChain::all());
    }

    public function getById($id)
    {
        return new EvolutionChainResource(EvolutionChain::where('pokemon_id', $id)->first());
    }

    public function store(Request $request)
    {
        $request->validate([
            'pokemon_id' => ['required', 'integer'],
            'evolution_chain' => ['nullable'],
        ]);

        return new EvolutionChainResource(EvolutionChain::create($request->validated()));
    }

    public function update(Request $request, EvolutionChain $evolutionChain)
    {
        $request->validate([
            'pokemon_id' => ['required', 'integer'],
            'evolution_chain' => ['nullable'],
        ]);

        $evolutionChain->update($request->validated());

        return new EvolutionChainResource($evolutionChain);
    }

    public function destroy(EvolutionChain $evolutionChain)
    {
        $evolutionChain->delete();

        return response()->json();
    }
}
