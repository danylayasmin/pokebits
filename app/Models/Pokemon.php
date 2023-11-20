<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $fillable = [
        'pokemon_id',
        'name',
        'sprite_front',
        'sprite_back',
        'artwork',
        'stat_hp',
        'stat_attack',
        'stat_defense',
        'stat_special_attack',
        'stat_special_defense',
        'stat_speed',
    ];
}
