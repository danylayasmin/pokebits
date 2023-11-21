<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PokemonType extends Model
{
    protected $fillable = [
        'pokemon',
        'type',
    ];

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, 'pokemon', 'name');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type', 'name');
    }
}
