<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use App\Models\Move;
use App\Models\PokemonType;
use App\Models\SpeciesType;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return TypeResource::collection(Type::all());
    }

    public function getByName($name)
    {
        $type = Type::where('name', $name)->first();
        if (!$type) {
            return errorJson('Type not found', 404);
        }
        return new TypeResource($type);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:types,name'],
            'double_damage_from' => ['nullable', 'array'],
            'double_damage_to' => ['nullable', 'array'],
            'half_damage_from' => ['nullable', 'array'],
            'half_damage_to' => ['nullable', 'array'],
            'no_damage_from' => ['nullable', 'array'],
            'no_damage_to' => ['nullable', 'array'],
        ]);

        return new TypeResource(Type::create($validated));
    }

    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:types,name'],
            'double_damage_from' => ['nullable', 'array'],
            'double_damage_to' => ['nullable', 'array'],
            'half_damage_from' => ['nullable', 'array'],
            'half_damage_to' => ['nullable', 'array'],
            'no_damage_from' => ['nullable', 'array'],
            'no_damage_to' => ['nullable', 'array'],
        ]);

        $isInUse = false;
        if(PokemonType::where('type', $type->name)->first() || SpeciesType::where('type_id', $type->id)->first() || Move::where('type', $type->name)->first()) {
            $isInUse = true;
        }

        if ($isInUse) {
            return errorJson('Type is in use and cannot be updated', 409);
        }

        $type->update($validated);

        return new TypeResource($type);
    }

    public function destroy(Type $type)
    {
        $isInUse = false;
        if(PokemonType::where('type', $type->name)->first() || SpeciesType::where('type_id', $type->id)->first() || Move::where('type', $type->name)->first()) {
            $isInUse = true;
        }

        if ($isInUse) {
            return errorJson('Type is in use and cannot be deleted', 409);
        }

        $type->delete();

        return response()->json();
    }
}
