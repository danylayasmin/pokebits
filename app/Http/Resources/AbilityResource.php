<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Ability */
class AbilityResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'effect' => $this->effect,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
