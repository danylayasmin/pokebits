<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Move extends Model
{
    protected $fillable = [
        'name',
        'accuracy',
        'effect_chance',
        'pp',
        'priority',
        'power',
        'type',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
