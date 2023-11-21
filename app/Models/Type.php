<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $fillable = [
        'name',
        'double_damage_from',
        'double_damage_to',
        'half_damage_from',
        'half_damage_to',
        'no_damage_from',
        'no_damage_to',
    ];

    protected $casts = [
        'double_damage_from' => 'array',
        'double_damage_to' => 'array',
        'half_damage_from' => 'array',
        'half_damage_to' => 'array',
        'no_damage_from' => 'array',
        'no_damage_to' => 'array',
    ];

    public function pokemon_type(): HasMany
    {
        return $this->hasMany(PokemonType::class, 'type', 'name');
    }
}
