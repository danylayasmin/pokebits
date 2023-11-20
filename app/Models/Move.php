<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $fillable = [
        'name',
        'accuracy',
        'effect_chance',
        'pp',
        'priority',
        'power',
        'type'
    ];
}
