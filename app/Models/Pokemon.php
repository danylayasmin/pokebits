<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id',
        'name',
        'sprite_front',
        'sprite_back',
        'artwork',
        'stat_speed',
        'stat_special_defense',
        'stat_special_attack',
        'stat_defense',
        'stat_attack',
        'stat_hp',
        'weight',
        'height',
    ];
}
