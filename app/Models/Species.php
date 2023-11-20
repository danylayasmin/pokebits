<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Species extends Model
{
    protected $fillable = [
        'pokemon_name',
        'description',
        'color_name',
        'color_hex',
        'shape',
        'base_happiness',
        'capture_rate',
        'habitat',
        'growth_rate',
        'is_baby',
        'is_legendary',
        'is_mythical',
    ];

    public function habitat(): BelongsTo
    {
        return $this->belongsTo(Habitat::class);
    }

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_name', 'name');
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'species_types');
    }

    public function evolutionChain(): HasOne
    {
        return $this->hasOne(EvolutionChain::class);
    }


}
