<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    /*
     * Your API path. By default, all routes starting with this path will be added to the docs.
     * If you need to change this behavior, you can add your custom routes resolver using `Scramble::routes()`.
     */
    'api_path' => 'api',

    /*
     * Your API domain. By default, app domain is used. This is also a part of the default API routes
     * matcher, so when implementing your own, make sure you use this config if needed.
     */
    'api_domain' => null,

    'info' => [
        /*
         * API version.
         */
        'version' => env('API_VERSION', '1.0'),

        /*
         * Description rendered on the home page of the API documentation (`/docs/api`).
         */
        'description' => "
# Welcome to Pokebits API! 🐉⚡
## OpenAPI Specification (OAS) 3.1.0
### 🎯 **Purpose and Mission**

At Pokebits, our mission revolves around crafting an API experience that's not just about accessing Pokémon data but delivering a seamless, hassle-free, and enriching journey into the Pokémon world.

#### **Empowering Developers**
Our primary goal is to empower developers by offering an intuitive, reliable, and meticulously documented API. We're committed to making your integration process as effortless as possible.

#### **Comprehensive Documentation**
The cornerstone of Pokebits lies in our dedication to comprehensive documentation. We understand the importance of clear, understandable, and robust guidance. Our documentation isn't just a guide; it's a map that leads you effortlessly through the vast world of Pokémon data.

#### **Efficiency at Its Core**
Efficient data filtering and caching are at the heart of Pokebits. We've fine-tuned our system to optimize data retrieval, ensuring speed and reliability in every query. Say goodbye to unnecessary hassles and welcome a smooth data access experience.

#### **Simplifying Development**
For frontend developers, navigating the intricacies of data caching can be challenging. Pokebits acts as a buffer, managing caching intricacies and allowing you to focus solely on crafting exceptional frontend experiences.

#### **PokeAPI Integration**
Leveraging data from PokeAPI, we've built a robust system that periodically syncs with PokeAPI, populating our database with the latest Pokémon data. This seamless integration ensures you have access to up-to-date information without worrying about breaking PokeAPI's fair-use policy.

#### **We've Got You Covered**
By handling caching intricacies and continuously updating our database, Pokebits alleviates the burden of data management, enabling you to dive into your frontend projects worry-free.

#### **Seamless Integration**
Whether you're building gaming apps, educational platforms, or simply exploring the Pokémon universe, our API seamlessly integrates into your projects, allowing you to focus on what you do best - creating remarkable experiences.
",
    ],

    /*
     * Customize Stoplight Elements UI
     */
    'ui' => [
        /*
         * Hide the `Try It` feature. Enabled by default.
         */
        'hide_try_it' => false,

        /*
         * URL to an image that displays as a small square logo next to the title, above the table of contents.
         */
        'logo' => 'https://wsrv.nl/?url=https://i.ibb.co/jzMJMX5/pokebits-OIG-removebg-preview.png&w=250&h=250&output=webp',
    ],

    /*
     * The list of servers of the API. By default, when `null`, server URL will be created from
     * `scramble.api_path` and `scramble.api_domain` config variables. When providing an array, you
     * will need to specify the local server URL manually (if needed).
     *
     * Example of non-default config (final URLs are generated using Laravel `url` helper):
     *
     * ```php
     * 'servers' => [
     *     'Live' => 'api',
     *     'Prod' => 'https://scramble.dedoc.co/api',
     * ],
     * ```
     */
    'servers' => [
        'Local' => 'api',
        'Production' => 'https://pokebits.by-a.dev/api',
    ],

    'middleware' => [
        'web',
    ],

    'extensions' => [],
];
