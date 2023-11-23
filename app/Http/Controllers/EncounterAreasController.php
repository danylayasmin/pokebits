<?php

namespace App\Http\Controllers;

use App\Http\Resources\EncounterAreasResource;
use App\Models\EncounterAreas;
use Illuminate\Http\Request;

class EncounterAreasController extends Controller
{
    public function index(Request $request)
    {
        $encounterAreas = EncounterAreas::query();

        if ($request->has('area')) {
            $encounterAreas->where('area_name', $request->input('area'));
        }

        if ($request->has('method')) {
            $encounterAreas->where('method', $request->input('method'));
        }

        if ($request->has('chance')) {
            $encounterAreas->where('chance', $request->input('chance'));
        }

        $response = $encounterAreas->get();

        return EncounterAreasResource::collection($response);
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
        $request->validate([
            'area_id' => ['required', 'integer'],
            'area_name' => ['required'],
            'pokemon_name' => ['required'],
            'method' => ['nullable'],
            'chance' => ['nullable', 'integer'],
        ]);

        return new EncounterAreasResource(EncounterAreas::create($request->validated()));
    }

    public function update(Request $request, EncounterAreas $encounterAreas)
    {
        $request->validate([
            'area_id' => ['required', 'integer'],
            'area_name' => ['required'],
            'pokemon_name' => ['required'],
            'method' => ['nullable'],
            'chance' => ['nullable', 'integer'],
        ]);

        $encounterAreas->update($request->validated());

        return new EncounterAreasResource($encounterAreas);
    }

    public function destroy(EncounterAreas $encounterAreas)
    {
        $encounterAreas->delete();

        return response()->json();
    }
}
