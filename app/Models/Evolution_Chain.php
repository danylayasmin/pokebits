<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolution_Chain extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id',
        'evolution_chain',
    ];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
