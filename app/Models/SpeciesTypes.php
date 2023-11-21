<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeciesTypes extends Model
{
    protected $fillable = [
        'species_id',
        'type_id',
    ];

    public function species_id(): BelongsTo
    {
        return $this->belongsTo(Species::class, 'species_id', 'id');
    }

    public function type_id(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
