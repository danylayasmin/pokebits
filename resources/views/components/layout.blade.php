<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pokébit @if(isset($title)) - {{ $title }} @endif</title>
</head>
<body class="flex flex-col min-h-screen">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl">
                <a href="{{ route('home') }}"><img src="https://i.ibb.co/jzMJMX5/pokebits-OIG-removebg-preview.png" alt="Pokébit" class="w-40 h-40"></a>
            </div>
        </header>
        <main>
            {{ $slot }}
        </main>
    </div>  
</body>
</html>