<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounter_Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'area_name',
        'pokemon_name',
        'method',
        'chance',
    ];
}
