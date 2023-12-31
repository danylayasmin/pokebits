<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbilityResource;
use App\Models\Ability;
use App\Models\PokemonAbility;
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
        $validated = $request->validate([
            'name' => ['required', 'unique:abilities'],
            'effect' => ['nullable'],
        ]);

        return new AbilityResource(Ability::create($validated));
    }

    public function update(Request $request, Ability $ability)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:abilities'],
            'effect' => ['nullable'],
        ]);

        $isInUse = PokemonAbility::where('ability', $ability->name)->first();

        if($isInUse) {
            return errorJson('Ability is in use and cannot be updated', 409);
        }

        $ability->update($validated);

        return new AbilityResource($ability);
    }

    public function destroy(Ability $ability)
    {
        $isInUse = PokemonAbility::where('ability', $ability->name)->first();

        if($isInUse) {
            return errorJson('Ability is in use and cannot be deleted', 409);
        }

        if(!$ability) {
            return errorJson('Ability not found', 404);
        }

        $ability->delete();

        return response()->json();
    }
}
