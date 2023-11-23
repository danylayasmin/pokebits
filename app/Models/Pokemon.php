<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Models\EvolutionChain;

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
        'height',
        'weight',
    ];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(
            Type::class,
            'pokemon_types',
            'pokemon',
            'type',
            'name',
            'name'
        );
    }

    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(
            Ability::class,
            'pokemon_abilities',
            'pokemon',
            'ability',
            'name',
            'name'
        );
    }

    public function species(): HasMany
    {
        return $this->hasMany(
            Species::class,
            'pokemon_name',
            'name'
        );
    }

    public function encounters(): HasMany
    {
        return $this->hasMany(
            EncounterAreas::class,
            'pokemon_name',
            'name'
        );
    }

    public function getEvolutionChain()
    {
        $evolutionChain = EvolutionChain::whereJsonContains('evolution_chain', $this->name)->first();

        if ($evolutionChain) {
            return $evolutionChain->evolution_chain;
        }

        return null;
    }

    public function habitat(): HasOneThrough
    {
        return $this->hasOneThrough(
            Habitat::class,
            Species::class,
            'pokemon_name',
            'name',
            'name',
            'habitat'
        );
    }
}
