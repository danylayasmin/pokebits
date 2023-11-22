<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\EncounterAreas */
class EncounterAreasResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'area_id' => $this->area_id,
            'area_name' => $this->area_name,
            'pokemon_name' => $this->pokemon_name,
            'method' => $this->method,
            'chance' => $this->chance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
