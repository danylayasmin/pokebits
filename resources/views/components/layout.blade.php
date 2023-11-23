<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pokébit @if(isset($title)) - {{ $title }} @endif</title>
</head>
<body>
    <header class="fixed w-full flex flex-row justify-between">
        <div class="flex flex-row items-center p-3 gap-2 text-white">
            <a href="{{ route('home') }}"><img src="https://i.ibb.co/jzMJMX5/pokebits-OIG-removebg-preview.png" alt="Pokébit" class="w-20 h-20"></a>
        </div>
        <nav class="flex flex-row items-center">
            <a href="{{ route('pokemon.index') }}" class="mr-4">Pokémon</a>
        
        </nav>
    </header>
    {{ $slot }}
    <footer class="fixed bottom-0 w-full bg-slate-900 flex justify-center mt-10">
    </footer>
</body>
</html>