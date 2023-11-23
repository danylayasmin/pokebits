<?php

namespace App\Http\Controllers;

use App\Http\Resources\HabitatResource;
use App\Models\Habitat;
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
            'name' => ['required'],
        ]);

        return new HabitatResource(Habitat::create($validated));
    }

    public function update(Request $request, Habitat $habitat)
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);

        $habitat->update($validated);

        return new HabitatResource($habitat);
    }

    public function destroy(Habitat $habitat)
    {
        $habitat->delete();

        return response()->json();
    }
}
