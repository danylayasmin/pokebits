# Pokébits 🐉⚡

Pokébits is an easy-to-use Pokémon data API with robust filtering, good documentation, and caching. We pull data from PokeAPI, store it ourselves, and handle caching so developers can focus on their front-end. We only provide English responses.

<p align="center"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&amp;logo=laravel&amp;logoColor=white" alt="shields"><img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&amp;logo=mysql&amp;logoColor=white" alt="shields"></p>

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
  php artisan db:seed
```

7. Run the server

```bash
  php artisan serve
```

## 👏 Acknowledgements

-   [PokeAPI](https://pokeapi.co/)
-   [How to write a Good readme](https://bulldogjob.com/news/449-how-to-write-a-good-readme-for-your-github-project)
-   [Deep Dive - Case files](https://bitacademy.notion.site/Deep-Dive-Pok-mon-4c6febe20a2c4184843165486f846f9f)
