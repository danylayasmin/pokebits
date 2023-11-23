<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
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
            'name' => ['required'],
            'double_damage_from' => ['nullable'],
            'double_damage_to' => ['nullable'],
            'half_damage_from' => ['nullable'],
            'half_damage_to' => ['nullable'],
            'no_damage_from' => ['nullable'],
            'no_damage_to' => ['nullable'],
        ]);

        return new TypeResource(Type::create($validated));
    }

    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'double_damage_from' => ['nullable'],
            'double_damage_to' => ['nullable'],
            'half_damage_from' => ['nullable'],
            'half_damage_to' => ['nullable'],
            'no_damage_from' => ['nullable'],
            'no_damage_to' => ['nullable'],
        ]);

        $type->update($validated);

        return new TypeResource($type);
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return response()->json();
    }
}
