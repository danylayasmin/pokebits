<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EncounterAreas extends Model
{
    protected $fillable = [
        'area_id',
        'area_name',
        'pokemon_name',
        'method',
        'chance',
    ];

    public function pokemon_name(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_name', 'name');
    }
}
