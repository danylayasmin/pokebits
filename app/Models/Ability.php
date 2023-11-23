<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = [
        'name',
        'effect',
    ];

    public function pokemon()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_abilities', 'ability', 'pokemon', 'name', 'name');
    }
}
