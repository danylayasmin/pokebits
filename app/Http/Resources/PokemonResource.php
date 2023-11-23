<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Pokemon */
class PokemonResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $array = [
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
        ];

        if ($this->relationLoaded('types')) {
            $array['types'] = $this->types->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'double_damage_from' => $type->double_damage_from,
                    'double_damage_to' => $type->double_damage_to,
                    'half_damage_from' => $type->half_damage_from,
                    'half_damage_to' => $type->half_damage_to,
                    'no_damage_from' => $type->no_damage_from,
                    'no_damage_to' => $type->no_damage_to,
                ];
            });
        }

        if ($this->relationLoaded('abilities')) {
            $array['abilities'] = $this->abilities->map(function ($ability) {
                return [
                    'id' => $ability->id,
                    'name' => $ability->name,
                    'description' => $ability->description,
                ];
            });
        }

        if ($this->relationLoaded('species')) {
            $array['species'] = $this->species->map(function ($species) {
                return [
                    'id' => $species->id,
                    'name' => $species->pokemon_name,
                    'description' => $species->description,
                ];
            });
        }

        if ($this->relationLoaded('encounters')) {
            $array['encounters'] = $this->encounters->map(function ($encounter) {
                return [
                    'id' => $encounter->id,
                    'location_area' => $encounter->area_name,
                    'method' => $encounter->method,
                    'chance' => $encounter->chance,
                ];
            });
        }

        if ($this->getEvolutionChain()) {
            $array['evolution_chain'] = $this->getEvolutionChain();
        }

        if ($this->relationLoaded('habitat')) {
            if ($this->habitat === null) {
                $array['habitat'] = null;
                return $array;
            }
            $array['habitat'] = [
                'id' => $this->habitat->id,
                'name' => $this->habitat->name,
            ];
        }

        return $array;
    }
}
