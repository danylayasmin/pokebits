<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonType extends Model
{
    protected $fillable = [
        'pokemon',
        'type',
    ];
}
