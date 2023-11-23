<?php

namespace App\Http\Controllers;

use App\Http\Resources\MoveResource;
use App\Models\Move;
use Illuminate\Http\Request;

class MoveController extends Controller
{
    public function index()
    {
        return MoveResource::collection(Move::all());
    }

    public function getByName($name)
    {
        $move = Move::where('name', $name)->get();
        if ($move->isEmpty()) {
            return errorJson('Move not found', 404);
        }
        return MoveResource::collection($move);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'accuracy' => ['nullable'],
            'effect_chance' => ['nullable', 'integer'],
            'pp' => ['nullable', 'integer'],
            'priority' => ['nullable', 'integer'],
            'power' => ['nullable', 'integer'],
            'type' => ['required']
        ]);

        return new MoveResource(Move::create($validated));
    }

    public function update(Request $request, Move $move)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'accuracy' => ['nullable'],
            'effect_chance' => ['nullable', 'integer'],
            'pp' => ['nullable', 'integer'],
            'priority' => ['nullable', 'integer'],
            'power' => ['nullable', 'integer'],
            'type' => ['required']
        ]);

        $move->update($validated);

        return new MoveResource($move);
    }

    public function destroy(Move $move)
    {
        $move->delete();

        return response()->json();
    }
}
