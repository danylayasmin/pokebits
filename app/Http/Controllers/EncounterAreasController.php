<?php

namespace App\Http\Controllers;

use App\Http\Resources\EncounterAreasResource;
use App\Models\EncounterAreas;
use Illuminate\Http\Request;

class EncounterAreasController extends Controller
{
    public function index()
    {
        return EncounterAreasResource::collection(EncounterAreas::all());
    }

    public function getByName($name)
    {
        $encounterAreas = EncounterAreas::where('area_name', $name)->get();
        if ($encounterAreas->isEmpty()) {
            return errorJson('Encounter area not found', 404);
        }
        return EncounterAreasResource::collection($encounterAreas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'area_id' => ['required', 'integer'],
            'area_name' => ['required'],
            'pokemon_name' => ['required'],
            'method' => ['nullable'],
            'chance' => ['nullable', 'integer'],
        ]);

        return new EncounterAreasResource(EncounterAreas::create($validated));
    }

    public function update(Request $request, EncounterAreas $encounterAreas)
    {
        $validated = $request->validate([
            'area_id' => ['required', 'integer'],
            'area_name' => ['required'],
            'pokemon_name' => ['required'],
            'method' => ['nullable'],
            'chance' => ['nullable', 'integer'],
        ]);

        $encounterAreas->update($validated);

        return new EncounterAreasResource($encounterAreas);
    }

    public function destroy(EncounterAreas $encounterAreas)
    {
        $encounterAreas->delete();

        return response()->json();
    }
}
