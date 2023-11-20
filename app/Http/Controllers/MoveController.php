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

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'accuracy' => ['required'],
            'effect_chance' => ['nullable', 'integer'],
            'pp' => ['required', 'integer'],
            'priority' => ['nullable', 'integer'],
            'power' => ['nullable', 'integer'],
            'type' => ['required']
        ]);

        return new MoveResource(Move::create($request->validated()));
    }

    public function show(Move $move)
    {
        return new MoveResource($move);
    }

    public function update(Request $request, Move $move)
    {
        $request->validate([
            'name' => ['required'],
            'accuracy' => ['required'],
            'effect_chance' => ['nullable', 'integer'],
            'pp' => ['required', 'integer'],
            'priority' => ['nullable', 'integer'],
            'power' => ['nullable', 'integer'],
        ]);

        $move->update($request->validated());

        return new MoveResource($move);
    }

    public function destroy(Move $move)
    {
        $move->delete();

        return response()->json();
    }
}
