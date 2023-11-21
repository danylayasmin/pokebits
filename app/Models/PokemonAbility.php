<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PokemonAbility extends Model
{
    protected $fillable = [
        'pokemon',
        'ability',
    ];

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, 'pokemon', 'name');
    }

    public function ability(): BelongsTo
    {
        return $this->belongsTo(Ability::class, 'ability', 'name');
    }
}
