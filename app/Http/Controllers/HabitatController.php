<?php

namespace App\Http\Controllers;

use App\Http\Resources\HabitatResource;
use App\Models\Habitat;
use App\Models\Species;
use Illuminate\Http\Request;

class HabitatController extends Controller
{
    public function index()
    {
        return HabitatResource::collection(Habitat::all());
    }

    public function getByName($name)
    {
        $habitat = Habitat::where('name', $name)->get();
        if ($habitat->isEmpty()) {
            return errorJson('Habitat not found', 404);
        }
        return HabitatResource::collection($habitat);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:habitats'],
        ]);

        return new HabitatResource(Habitat::create($validated));
    }

    public function update(Request $request, Habitat $habitat)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:habitats'],
        ]);

        $isInUse = Species::where('habitat', $habitat->name)->first();

        if ($isInUse) {
            return errorJson('Habitat is in use and cannot be updated', 409);
        }

        $habitat->update($validated);

        return new HabitatResource($habitat);
    }

    public function destroy(Habitat $habitat)
    {
        $isInUse = Species::where('habitat', $habitat->name)->first();

        if ($isInUse) {
            return errorJson('Habitat is in use and cannot be deleted', 409);
        }

        $habitat->delete();

        return response()->json();
    }
}
