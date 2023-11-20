<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pokemon_name',
        'description',
        'types',
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
}
