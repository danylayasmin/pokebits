<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpeciesTypes extends Model
{
    protected $fillable = [
        'species_id',
        'type_id',
    ];
}
