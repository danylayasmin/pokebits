<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\EvolutionChain */
class EvolutionChainResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'pokemon_id' => $this->pokemon_id,
            'evolution_chain' => $this->evolution_chain,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
