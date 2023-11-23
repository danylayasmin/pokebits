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
                    'name' => $species->name,
                    'description' => $species->description,
                    'generation' => $species->generation,
                    'is_legendary' => $species->is_legendary,
                    'is_mythical' => $species->is_mythical,
                ];
            });
        }

        if ($this->relationLoaded('encounters')) {
            $array['encounters'] = $this->encounters->map(function ($encounter) {
                return [
                    'id' => $encounter->id,
                    'location_area' => $encounter->location_area,
                    'version' => $encounter->version,
                    'method' => $encounter->method,
                    'level_min' => $encounter->level_min,
                    'level_max' => $encounter->level_max,
                ];
            });
        }

        if ($this->relationLoaded('evolution_chain')) {
            $array['evolution_chain'] = $this->evolution_chain->map(function ($evolution_chain) {
                return [
                    'id' => $evolution_chain->id,
                    'evolution_chain' => $evolution_chain->evolution_chain,
                ];
            });
        }

        if ($this->relationLoaded('habitat')) {
            $array['habitat'] = $this->habitat->map(function ($habitat) {
                return [
                    'id' => $habitat->id,
                    'name' => $habitat->name,
                ];
            });
        }

        return $array;
    }
}
