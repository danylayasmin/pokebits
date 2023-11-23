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
        $evolutionChain = EvolutionChain::where('id', $id)->first();
        if (!$evolutionChain) {
            return errorJson('Evolution chain not found', 404);
        }
        return new EvolutionChainResource($evolutionChain);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pokemon_id' => ['required', 'integer', 'exists:pokemon,id'],
            'evolution_chain' => ['nullable', 'array'],
        ]);

        return new EvolutionChainResource(EvolutionChain::create($validated));
    }

    public function update(Request $request, EvolutionChain $evolutionChain)
    {
        $validated = $request->validate([
            'pokemon_id' => ['integer', 'required', 'exists:pokemon,id'],
            'evolution_chain' => ['required', 'array'],
        ]);

        $evolutionChain->update($validated);

        return new EvolutionChainResource($evolutionChain);
    }

    public function destroy(EvolutionChain $evolutionChain)
    {
        $evolutionChain->delete();

        return response()->json();
    }
}
