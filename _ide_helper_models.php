<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Ability
 *
 * @property int $id
 * @property string $name
 * @property string|null $effect
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ability query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ability whereEffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ability whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ability whereUpdatedAt($value)
 */
	class Ability extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EncounterAreas
 *
 * @property int $id
 * @property int $area_id
 * @property string $area_name
 * @property string $pokemon_name
 * @property string|null $method
 * @property int|null $chance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pokemon $pokemon
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas query()
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas wherePokemonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EncounterAreas whereUpdatedAt($value)
 */
	class EncounterAreas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EvolutionChain
 *
 * @property int $id
 * @property int $pokemon_id
 * @property array|null $evolution_chain
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pokemon $pokemon
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain whereEvolutionChain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain wherePokemonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvolutionChain whereUpdatedAt($value)
 */
	class EvolutionChain extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Habitat
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Habitat whereUpdatedAt($value)
 */
	class Habitat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $id
 * @property string $name
 * @property string|null $effect
 * @property string|null $description
 * @property string|null $sprite
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereEffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSprite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Move
 *
 * @property int $id
 * @property string $name
 * @property int|null $accuracy
 * @property int|null $effect_chance
 * @property int|null $pp
 * @property int|null $priority
 * @property int|null $power
 * @property \App\Models\Type $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Move newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Move newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Move query()
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereAccuracy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereEffectChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move wherePower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move wherePp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Move whereUpdatedAt($value)
 */
	class Move extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pokemon
 *
 * @property int $id
 * @property int $pokemon_id
 * @property string $name
 * @property string|null $sprite_front
 * @property string|null $sprite_back
 * @property string|null $artwork
 * @property int $stat_hp
 * @property int $stat_attack
 * @property int $stat_defense
 * @property int $stat_special_attack
 * @property int $stat_special_defense
 * @property int $stat_speed
 * @property int $height
 * @property int $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereArtwork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon wherePokemonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereSpriteBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereSpriteFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereStatAttack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereStatDefense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereStatHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereStatSpecialAttack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereStatSpecialDefense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereStatSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pokemon whereWeight($value)
 */
	class Pokemon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PokemonAbility
 *
 * @property int $id
 * @property \App\Models\Pokemon $pokemon
 * @property \App\Models\Ability $ability
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility query()
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility whereAbility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility wherePokemon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonAbility whereUpdatedAt($value)
 */
	class PokemonAbility extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PokemonType
 *
 * @property int $id
 * @property \App\Models\Pokemon $pokemon
 * @property \App\Models\Type $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType wherePokemon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PokemonType whereUpdatedAt($value)
 */
	class PokemonType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Species
 *
 * @property int $id
 * @property string $pokemon_name
 * @property string|null $description
 * @property string $color_name
 * @property string $color_hex
 * @property string|null $shape
 * @property int|null $base_happiness
 * @property int|null $capture_rate
 * @property \App\Models\Habitat|null $habitat
 * @property string|null $growth_rate
 * @property int $is_baby
 * @property int $is_legendary
 * @property int $is_mythical
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pokemon $pokemon
 * @method static \Illuminate\Database\Eloquent\Builder|Species newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Species newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Species query()
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereBaseHappiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereCaptureRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereColorHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereColorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereGrowthRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereHabitat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereIsBaby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereIsLegendary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereIsMythical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species wherePokemonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereShape($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereUpdatedAt($value)
 */
	class Species extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SpeciesType
 *
 * @property int $id
 * @property int $species_id
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Species $species
 * @property-read \App\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType whereSpeciesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpeciesType whereUpdatedAt($value)
 */
	class SpeciesType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Type
 *
 * @property int $id
 * @property string $name
 * @property array|null $double_damage_from
 * @property array|null $double_damage_to
 * @property array|null $half_damage_from
 * @property array|null $half_damage_to
 * @property array|null $no_damage_from
 * @property array|null $no_damage_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereDoubleDamageFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereDoubleDamageTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereHalfDamageFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereHalfDamageTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereNoDamageFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereNoDamageTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 */
	class Type extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property mixed $password
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

