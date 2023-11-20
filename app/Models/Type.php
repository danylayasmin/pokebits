<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'double_damage_from',
        'double_damage_to',
        'half_damage_from',
        'half_damage_to',
        'no_damage_from',
        'no_damage_to',
    ];
}
