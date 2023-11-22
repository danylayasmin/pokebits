<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\PokemonAbility */
class PokemonAbilityResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'pokemon' => $this->pokemon,
            'ability' => $this->ability,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
