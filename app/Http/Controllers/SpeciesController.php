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
        $request->validate([
            'pokemon_name' => ['required'],
            'description' => ['nullable'],
            'types' => ['required'],
            'color_name' => ['required'],
            'color_hex' => ['required'],
            'shape' => ['required'],
            'base_happiness' => ['required', 'integer'],
            'capture_rate' => ['required', 'integer'],
            'habitat' => ['required'],
            'growth_rate' => ['required', 'integer'],
            'is_baby' => ['required'],
            'is_legendary' => ['required'],
            'is_mythical' => ['required'],
        ]);

        return new SpeciesResource(Species::create($request->validated()));
    }

    public function update(Request $request, Species $species)
    {
        $request->validate([
            'pokemon_name' => ['required'],
            'description' => ['nullable'],
            'types' => ['required'],
            'color_name' => ['required'],
            'color_hex' => ['required'],
            'shape' => ['required'],
            'base_happiness' => ['required', 'integer'],
            'capture_rate' => ['required', 'integer'],
            'habitat' => ['required'],
            'growth_rate' => ['required', 'integer'],
            'is_baby' => ['required'],
            'is_legendary' => ['required'],
            'is_mythical' => ['required'],
        ]);

        $species->update($request->validated());

        return new SpeciesResource($species);
    }

    public function destroy(Species $species)
    {
        $species->delete();

        return response()->json();
    }
}
