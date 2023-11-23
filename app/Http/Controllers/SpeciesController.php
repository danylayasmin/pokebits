<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpeciesResource;
use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index()
    {
        return SpeciesResource::collection(Species::all());
    }

    public function getByName($name)
    {
        $species = Species::where('pokemon_name', $name)->first();
        if(!$species) {
            return errorJson('Species not found', 404);
        }
        return new SpeciesResource($species);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pokemon_name' => ['required', 'exists:pokemon,name'],
            'description' => ['nullable'],
            'color_name' => ['required'],
            'color_hex' => ['required'],
            'shape' => ['required'],
            'base_happiness' => ['required', 'integer'],
            'capture_rate' => ['required', 'integer'],
            'habitat' => ['required', 'exists:habitats,name'],
            'growth_rate' => ['required', 'integer'],
            'is_baby' => ['required', 'boolean'],
            'is_legendary' => ['required', 'boolean'],
            'is_mythical' => ['required', 'boolean'],
        ]);

        return new SpeciesResource(Species::create($validated));
    }

    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'pokemon_name' => ['required', 'exists:pokemon,name'],
            'description' => ['nullable'],
            'color_name' => ['required'],
            'color_hex' => ['required'],
            'shape' => ['required'],
            'base_happiness' => ['required', 'integer'],
            'capture_rate' => ['required', 'integer'],
            'habitat' => ['required', 'exists:habitats,name'],
            'growth_rate' => ['required', 'integer'],
            'is_baby' => ['required', 'boolean'],
            'is_legendary' => ['required', 'boolean'],
            'is_mythical' => ['required', 'boolean'],
        ]);

        $species->update($validated);

        return new SpeciesResource($species);
    }

    public function destroy(Species $species)
    {
        $species->delete();

        return response()->json();
    }
}
