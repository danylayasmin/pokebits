<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbilityResource;
use App\Models\Ability;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function index()
    {
        $abilties = Ability::query();

        if (request()->has('sort')) {
            $abilties->orderBy(request()->input('sort'));
        }

        return AbilityResource::collection($abilties->get());
    }

    public function getByName($name)
    {
        $ability = Ability::where('name', $name)->first();
        if(!$ability) {
            return errorJson('Ability not found', 404);
        }
        return new AbilityResource($ability);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'effect' => ['nullable'],
        ]);

        return new AbilityResource(Ability::create($request->validated()));
    }

    public function update(Request $request, Ability $ability)
    {
        $request->validate([
            'name' => ['required'],
            'effect' => ['nullable'],
        ]);

        $ability->update($request->validated());

        return new AbilityResource($ability);
    }

    public function destroy(Ability $ability)
    {
        $ability->delete();

        return response()->json();
    }
}
