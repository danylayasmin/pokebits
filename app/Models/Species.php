<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsTo(Habitat::class, 'habitat', 'name');
    }

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_name', 'name');
    }

    public function species_type(): HasMany
    {
        return $this->hasMany(SpeciesType::class, 'species_id', 'id');
    }
}
