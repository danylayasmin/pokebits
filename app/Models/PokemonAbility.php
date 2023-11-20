<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonAbility extends Model
{
    protected $fillable = [
        'pokemon',
        'ability',
    ];
}
