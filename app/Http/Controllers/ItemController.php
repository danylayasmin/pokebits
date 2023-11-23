<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return ItemResource::collection(Item::all());
    }

    public function getByName($name)
    {
        $item = Item::where('name', $name)->get();
        if (!$item) {
            return errorJson('Item not found', 404);
        }
        return ItemResource::collection($item);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'effect' => ['nullable'],
            'description' => ['nullable'],
            'sprite' => ['nullable'],
        ]);

        return new ItemResource(Item::create($request->validated()));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => ['required'],
            'effect' => ['nullable'],
            'description' => ['nullable'],
            'sprite' => ['nullable'],
        ]);

        $item->update($request->validated());

        return new ItemResource($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json();
    }
}
