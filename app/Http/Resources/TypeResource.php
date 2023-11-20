<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Type */
class TypeResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'double_damage_from' => $this->double_damage_from,
            'double_damage_to' => $this->double_damage_to,
            'half_damage_from' => $this->half_damage_from,
            'half_damage_to' => $this->half_damage_to,
            'no_damage_from' => $this->no_damage_from,
            'no_damage_to' => $this->no_damage_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
