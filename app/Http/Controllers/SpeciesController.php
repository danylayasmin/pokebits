<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpeciesResource;
use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index(Request $request)
    {
        $species = Species::query();

        if ($request->has('color')) {
            $species->where('color_name', $request->input('color'));
        }

        if ($request->has('shape')) {
            $species->where('shape', $request->input('shape'));
        }

        if ($request->has('hapiness')) {
            $species->where('base_hapiness', $request->input('hapiness'));
        }

        if ($request->has('capture_rate')) {
            $species->where('capture_rate', $request->input('capture_rate'));
        }

        if ($request->has('habitat')) {
            $species->where('habitat', $request->input('habitat'));
        }

        if ($request->has('growth_rate')) {
            $species->where('growth_rate', $request->input('growth_rate'));
        }

        if ($request->has('baby')) {
            $species->where('is_baby', $request->input('baby'));
        }

        if ($request->has('legendary')) {
            $species->where('is_legendary', $request->input('legendary'));
        }

        if ($request->has('mythical')) {
            $species->where('is_mythical', $request->input('mythical'));
        }

        if ($request->has('sort')) {
            $species->orderBy($request->input('sort'));
        }
        
        return SpeciesResource::collection($species->get());
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
