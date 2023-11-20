<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncounterAreas extends Model
{
    protected $fillable = [
        'area_id',
        'area_name',
        'pokemon_name',
        'method',
        'chance',
    ];
}
