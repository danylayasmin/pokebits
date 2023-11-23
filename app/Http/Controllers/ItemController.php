<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;

use phpDocumentor\Reflection\Types\Integer;

use function PHPUnit\Framework\isEmpty;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::query();

        if (request()->has('sort')) {
            $items->orderBy(request()->input('sort'));
        }

        return ItemResource::collection($items->get());
    }

    public function getByName($name)
    {
        $item = Item::where('name', $name)->get();
        if ($item->isEmpty()) {
            return errorJson('Item not found', 404);
        }
        return ItemResource::collection($item);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:items'],
            'effect' => ['nullable'],
            'description' => ['nullable'],
            'sprite' => ['nullable'],
        ]);

        return new ItemResource(Item::create($validated));
    }

    public function update(Request $request, int $id)
    {
        $item = Item::find($id);

        if (empty($item)) {
            return errorJson('Item not found', 404);
        }

        $validated = $request->validate([
            'name' => ['required', 'unique:items,name'],
            'effect' => ['nullable'],
            'description' => ['nullable'],
            'sprite' => ['nullable'],
        ]);

        try {
            $item->update($validated);
        } catch (Exception $e) {
            return errorJson($e->getMessage(), 500);
        }

        return new ItemResource($item);
    }

    public function destroy(int $id)
    {
        $item = Item::find($id);
        
        if (empty($item)) {
            return errorJson('Item not found', 404);
        }

        $item->delete();

        return response()->json();
    }
}
