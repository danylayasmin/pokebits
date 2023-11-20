<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Species */
class SpeciesResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'pokemon_name' => $this->pokemon_name,
            'description' => $this->description,
            'types' => $this->types,
            'color_name' => $this->color_name,
            'color_hex' => $this->color_hex,
            'shape' => $this->shape,
            'base_happiness' => $this->base_happiness,
            'capture_rate' => $this->capture_rate,
            'habitat' => $this->habitat,
            'growth_rate' => $this->growth_rate,
            'is_baby' => $this->is_baby,
            'is_legendary' => $this->is_legendary,
            'is_mythical' => $this->is_mythical,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
