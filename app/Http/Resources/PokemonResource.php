<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Pokemon */
class PokemonResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'pokemon_id' => $this->pokemon_id,
            'name' => $this->name,
            'sprite_front' => $this->sprite_front,
            'sprite_back' => $this->sprite_back,
            'artwork' => $this->artwork,
            'stat_hp' => $this->stat_hp,
            'stat_attack' => $this->stat_attack,
            'stat_defense' => $this->stat_defense,
            'stat_special_attack' => $this->stat_special_attack,
            'stat_special_defense' => $this->stat_special_defense,
            'stat_speed' => $this->stat_speed,
            'height' => $this->height,
            'weight' => $this->weight,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
