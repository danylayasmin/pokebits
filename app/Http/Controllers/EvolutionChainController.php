<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvolutionChainResource;
use App\Models\EvolutionChain;
use Illuminate\Http\Request;

class EvolutionChainController extends Controller
{
    public function index()
    {
        $evolutionChains = EvolutionChain::query();

        if (request()->has('sort')) {
            $evolutionChains->orderBy(request()->input('sort'));
        }

        return EvolutionChainResource::collection($evolutionChains->get());
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
