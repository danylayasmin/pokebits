<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::query();

        if (request()->has('sort')) {
            $types->orderBy(request()->input('sort'));
        }

        return TypeResource::collection($types->get());
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
        $request->validate([
            'name' => ['required'],
            'double_damage_from' => ['nullable'],
            'double_damage_to' => ['nullable'],
            'half_damage_from' => ['nullable'],
            'half_damage_to' => ['nullable'],
            'no_damage_from' => ['nullable'],
            'no_damage_to' => ['nullable'],
        ]);

        return new TypeResource(Type::create($request->validated()));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => ['required'],
            'double_damage_from' => ['nullable'],
            'double_damage_to' => ['nullable'],
            'half_damage_from' => ['nullable'],
            'half_damage_to' => ['nullable'],
            'no_damage_from' => ['nullable'],
            'no_damage_to' => ['nullable'],
        ]);

        $type->update($request->validated());

        return new TypeResource($type);
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return response()->json();
    }
}
