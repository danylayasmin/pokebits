# Pokébits 🐉⚡

Pokébits is an easy-to-use Pokémon data API with robust filtering, good documentation, and caching. We pull data from PokeAPI, store it ourselves, and handle caching so developers can focus on their front-end. We only provide English responses.

<p align="center"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&amp;logo=laravel&amp;logoColor=white" alt="shields"><img src="https://img.shields.io/badge/MySQL-00618a?style=for-the-badge&amp;logo=mysql&amp;logoColor=white" alt="shields"></p>

## 📝 Authors

-   Danyla | [Github](https://github.com/danylayasmin) - [Bitlab](https://bitlab.bit-academy.nl/danylahuntjens)
-   Martijn | [Github](https://github.com/MartijnKerpentier) - [Bitlab](https://bitlab.bit-academy.nl/martijnkerpentier)
-   Rico | [Github](https://github.com/rico-vz) - [Bitlab](https://bitlab.bit-academy.nl/ricovanzelst)

## 📄 Documentation

You can find all of our documentation in our [/docs directory.](https://bitlab.bit-academy.nl/martijnkerpentier/pokebits/-/tree/main/docs?ref_type=heads)

If you're looking for our API Reference check out [our OpenAPI Spec](#todo)

## ⚙️ Tech Stack

-   PHP 8.2
-   Laravel 10
-   MySQL
-   Intervention Image

## 🚀 Run Locally

#### Requirements

-   PHP 8.2+
-   Composer
-   MySQL
<details>
<summary>PHP Extensions</summary>

-   PHP-GD _or_ PHP-Imagick
-   Ctype PHP Extension
-   cURL PHP Extension
-   DOM PHP Extension
-   Fileinfo PHP Extension
-   Filter PHP Extension
-   Hash PHP Extension
-   Mbstring PHP Extension
-   OpenSSL PHP Extension
-   PCRE PHP Extension
-   PDO PHP Extension
-   Session PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
</details>

---

1. Clone the project

```bash
  git clone git@bitlab.bit-academy.nl:martijnkerpentier/pokebits.git
```

2. Go to the project directory

```bash
  cd pokebits
```

3. Install dependencies

```bash
  composer install
```

4. Set up your .env

```bash
  cp .env.example .env
```

Now, fill in your details in the `.env`

5. Run the database migrations

```bash
  php artisan migrate
```

6. Seed the database tables with data

```bash
  php artisan pokeapi:all
```

This will prompt you, asking if you'd like to populate your database from a complete SQL dump or from the PokeAPI.
Populating from the dump is recommended as it is much faster. 

7. Run the server

```bash
  php artisan serve
```

## ❓ F.A.Q.

<details>
<summary>Question: What endpoints can I use?</summary>

Answer: You can find all of our endpoints in our OpenAPI spec which you can find at /docs/api.
</details>

<details>
<summary>Question: What are the rate limits?</summary>

Answer: The current rate limit for each endpoint is 150 requests per minute. To track the ratelimits you can check the HTTP headers. X-RateLimit-Limit which shows you the total and X-RateLimit-Remaining which is how many requests you have remaining.
</details>

<details>
<summary>Question: I get the error 429 / I got rate limited, what now?</summary>

Answer: Don't worry. The rate limit isn't permanent. Please wait a few minutes and try again.
</details>

<details>
<summary>Question: Why do I get "'mysql' is not recognized as an internal or external command" when populating the DB with `dump`?</summary>

Answer: To populate the database, it calls the process "mysql" from the command line. If you have MySQL installed but you still get this error, it means it's not added to path. To add it, find the location of `mysql.exe` and add it to path [guide here ](https://www.architectryan.com/2018/03/17/add-to-the-path-on-windows-10/).
</details>

<details>
<summary>Question: Why does populating the DB through PokeAPI take a while?</summary>

Answer: When populating the database using the PokeAPI commands, it takes a while. This is because it'll make a bunch of requests to PokeAPI to request the information and inserts it. The dump option is much faster and the dump is updated every game release, so it'll be up-to-date.
</details>

<details><summary>Question: How do I filter my data on specific requirements? - "The attack of a pokemon is equal to 48"</summary>

Answer: When wanting to filter, type the applied filters in the search bar, next to the url.
"localhost:8000/api/pokemon?attack=48".

With multiple filters, type '&' between each filter: "localhost:8000/api/pokemon?attack=48&height=5".
</details>

<details><summary>Question: How do I sort my data on name, or other fields?</summary>

Answer: When wanting to sort, type the sorting field in the search bar, next to the url.
"localhost:8000/api/pokemon?sort=name".

It is not possible to sort in more than one way.
</details>

## 📚 Examples
<details>
<summary>Vanilla JavaScript</summary>

```javascript
fetch('<POKEBITS_URL>/api/pokemon')
  .then(response => response.json())
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Error:', error);
  });
```
</details>

<details>
<summary>TypeScript</summary>

```typescript
interface Pokemon {
    id: number;
    name: string;
    type: string;
    // Add more properties as per your API response structure
}

interface ApiResponse {
    count: number;
    results: Pokemon[];
    // Add more properties as per your API response structure
}

async function fetchPokemonData(): Promise<void> {
    try {
        const response = await fetch('<POKEBITS_URL>/api/pokemon');
        if (!response.ok) {
            throw new Error(`Request failed with status: ${response.status}`);
        }
        const data: ApiResponse = await response.json();
        console.log(data.results); // Access the array of Pokémon
    } catch (error) {
        console.error('Error:', error);
    }
}

fetchPokemonData();
```
</details>

<details>
<summary>Node using Fetch</summary>

```javascript
const fetch = require('node-fetch');

fetch('<POKEBITS_URL>/api/pokemon')
  .then(response => response.json())
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Error:', error);
  });
```
</details>

<details>
<summary>React</summary>

```javascript
import React, { useEffect } from 'react';

function PokemonComponent() {
  useEffect(() => {
    fetch('<POKEBITS_URL>/api/pokemon')
      .then(response => response.json())
      .then(data => {
        console.log(data);
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }, []);

  return <div>Pokemon Component</div>;
}

export default PokemonComponent;
```
</details>

<details>
<summary>Python</summary>

```python
import requests

response = requests.get('<POKEBITS_URL>/api/pokemon')
if response.status_code == 200:
    data = response.json()
    print(data)
else:
    print('Error:', response.status_code)
```
</details>

<details>
<summary>Go</summary>

```go
package main

import (
	"fmt"
	"io/ioutil"
	"net/http"
)

func main() {
	resp, err := http.Get("<POKEBITS_URL>/api/pokemon")
	if err != nil {
		fmt.Println("Error:", err)
		return
	}
	defer resp.Body.Close()

	body, err := ioutil.ReadAll(resp.Body)
	if err != nil {
		fmt.Println("Error:", err)
		return
	}

	fmt.Println(string(body))
}
```
</details>

<details>
<summary>Ruby on Rails</summary>

```ruby
require 'net/http'
require 'json'

url = URI('<POKEBITS_URL>/api/pokemon')
response = Net::HTTP.get(url)
data = JSON.parse(response)
puts data
```
</details>

<details>
<summary>PHP with Guzzle</summary>

```php
<?php
require 'vendor/autoload.php';

$client = new \GuzzleHttp\Client();
$response = $client->request('GET', '<POKEBITS_URL>/api/pokemon');
$data = json_decode($response->getBody(), true);
print_r($data);
```
</details>

<details>
<summary>Rust</summary>

```rust
extern crate reqwest;

fn main() {
    let url = "<POKEBITS_URL>/api/pokemon";
    let response = reqwest::blocking::get(url).expect("Failed to get a response");
    
    if response.status().is_success() {
        let body = response.text().expect("Failed to get response body");
        println!("{}", body);
    } else {
        println!("Error: {:?}", response.status());
    }
}
```
</details>

<details>
<summary>C++</summary>

```cpp
#include <iostream>
#include <curl/curl.h>
#include <string>

int main() {
  CURL *curl;
  CURLcode res;
  std::string url = "<POKEBITS_URL>/api/pokemon";

  curl = curl_easy_init();
  if (curl) {
    curl_easy_setopt(curl, CURLOPT_URL, url.c_str());

    res = curl_easy_perform(curl);
    if (res != CURLE_OK) {
      fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
    }

    curl_easy_cleanup(curl);
  }

  return 0;
}
```
</details>



## 👏 Acknowledgements

-   [PokeAPI](https://pokeapi.co/)
-   [How to write a Good readme](https://bulldogjob.com/news/449-how-to-write-a-good-readme-for-your-github-project)
-   [Deep Dive - Case files](https://bitacademy.notion.site/Deep-Dive-Pok-mon-4c6febe20a2c4184843165486f846f9f)
