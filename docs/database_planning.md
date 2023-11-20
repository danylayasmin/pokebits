# 📝 **Database Planning for Pokémon API**

### Pokemons Table

-   `id`: Unique identifier for each Pokémon.
-   `pokemon_id`: Identifier for the Pokémon.
-   `name`: Name of the Pokémon.
-   `sprite_front`: URL/link for the front sprite image.
-   `sprite_back`: URL/link for the back sprite image.
-   `artwork`: URL/link for the artwork image.
-   `stat_speed`, `stat_special_defense`, `stat_special_attack`, `stat_defense`, `stat_attack`, `stat_hp`: Attributes for various statistics.
-   `weight`: Weight of the Pokémon.
-   `height`: Height of the Pokémon.

### Species Table

-   `id`: Unique identifier for each species.
-   `pokemon_name`: Foreign key referencing Pokémon name.
-   `description`: Description of the Pokémon species.
-   `types`: Array containing Pokémon types (e.g., `['grass', 'poison']`).
-   `color_name`, `color_hex`: Attributes about the color of the Pokemon.
-   `shape`: Shape of the Pokémon.
-   `base_happiness`, `capture_rate`: Values for happiness and capture rate.
-   `habitat`: Foreign key referencing habitat name.
-   `growth_rate`: Rate at which the Pokémon grows.
-   `is_baby`, `is_legendary`, `is_mythical`: Boolean values for specific traits.

### Evolution_Chains Table

-   `id`: Unique identifier for each evolution chain.
-   `pokemon_id`: Foreign key referencing Pokémon id.
-   `evolution_chain`: Array representing the evolution chain (e.g., `['bulbasaur', 'ivysaur', 'venusaur']`).

### Encounter_Areas Table

-   `id`: Unique identifier for each encounter area.
-   `area_id`, `area_name`: Identification and name of the area.
-   `pokemon_name`: Foreign key referencing Pokémon name.
-   `method`: Method of encountering the Pokémon.
-   `chance`: Probability/chance of encountering the Pokémon.

### Items Table

-   `id`: Unique identifier for each item.
-   `name`: Name of the item.
-   `effect`: Effect (description) of the item.
-   `description`: Description of the item.
-   `sprite`: URL/link for the item's sprite.

### Moves Table

-   `id`: Unique identifier for each move.
-   `name`: Name of the move.
-   `accuracy`, `effect_chance`, `pp`, `priority`, `power`: Attributes related to the move statistics.
-   `type`: Foreign key referencing type name.

### Abilities Table

-   `id`: Unique identifier for each ability.
-   `name`: Name of the ability.
-   `effect`: Effect description of the ability.

### Habitats Table

-   `id`: Unique identifier for each habitat.
-   `name`: Name of the habitat.
-   `effect`: Effect of the habitat.
-   `description`: Description of the habitat.

### Types Table

-   `id`: Unique identifier for each type.
-   `name`: Name of the type.
-   `double_damage_from`, `double_damage_to`, `half_damage_from`, `half_damage_to`, `no_damage_from`, `no_damage_to`: Arrays listing type interactions (e.g., `['flying', 'steel']`).

### Pokemon_Abilities Table (pivot)

-   `id`: Unique identifier for Pokémon abilities.
-   `pokemon`: Foreign key referencing Pokémon name.
-   `ability`: Foreign key referencing ability name.

### Pokemon_Types Table (pivot)

-   `id`: Unique identifier for Pokémon types.
-   `pokemon`: Foreign key referencing Pokémon name.
-   `type`: Foreign key referencing type name.

Please note that slight changes might occur during development.
