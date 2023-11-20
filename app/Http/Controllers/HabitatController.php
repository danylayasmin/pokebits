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

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'effect' => ['nullable'],
            'description' => ['nullable'],
        ]);

        return new HabitatResource(Habitat::create($request->validated()));
    }

    public function show(Habitat $habitat)
    {
        return new HabitatResource($habitat);
    }

    public function update(Request $request, Habitat $habitat)
    {
        $request->validate([
            'name' => ['required'],
            'effect' => ['nullable'],
            'description' => ['nullable'],
        ]);

        $habitat->update($request->validated());

        return new HabitatResource($habitat);
    }

    public function destroy(Habitat $habitat)
    {
        $habitat->delete();

        return response()->json();
    }
}
