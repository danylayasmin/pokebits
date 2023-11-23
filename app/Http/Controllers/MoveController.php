<?php

namespace App\Http\Controllers;

use App\Http\Resources\MoveResource;
use App\Models\Move;
use Illuminate\Http\Request;

class MoveController extends Controller
{
    public function index(Request $request)
    {
        $moves = Move::query();

        if ($request->has('accuracy')) {
            $moves->where('accuracy', $request->input('accuracy'));
        }

        if ($request->has('effect_chance')) {
            $moves->where('effect_chance', $request->input('effect_chance'));
        }

        if ($request->has('pp')) {
            $moves->where('pp', $request->input('pp'));
        }

        if ($request->has('priority')) {
            $moves->where('priority', $request->input('priority'));
        }

        if ($request->has('power')) {
            $moves->where('power', $request->input('power'));
        }

        if ($request->has('type')) {
            $moves->where('type', $request->input('type'));
        }

        if ($request->has('sort')) {
            $moves->orderBy($request->input('sort'));
        }

        $response = $moves->get();

        return MoveResource::collection($response);
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
        $request->validate([
            'name' => ['required'],
            'accuracy' => ['nullable'],
            'effect_chance' => ['nullable', 'integer'],
            'pp' => ['nullable', 'integer'],
            'priority' => ['nullable', 'integer'],
            'power' => ['nullable', 'integer'],
            'type' => ['required']
        ]);

        return new MoveResource(Move::create($request->validated()));
    }

    public function update(Request $request, Move $move)
    {
        $request->validate([
            'name' => ['required'],
            'accuracy' => ['nullable'],
            'effect_chance' => ['nullable', 'integer'],
            'pp' => ['nullable', 'integer'],
            'priority' => ['nullable', 'integer'],
            'power' => ['nullable', 'integer'],
            'type' => ['required']
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
