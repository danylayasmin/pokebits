<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvolutionChain extends Model
{
    protected $fillable = [
        'pokemon_id',
        'evolution_chain',
    ];

    protected $casts = [
        'evolution_chain' => 'array',
    ];

    public function pokemon_id()
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_id', 'pokemon_id');
    }
}
