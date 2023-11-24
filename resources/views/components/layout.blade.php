<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pokébits @if(isset($title)) - {{ $title }} @endif</title>

    <link rel="shortcut icon" href="https://i.ibb.co/jzMJMX5/pokebits-OIG-removebg-preview.png" type="image/x-icon">
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-r from-red-500 to-yellow-500">
    <div class="min-h-screen">
        <header class="mt-20">
            <div class="mx-auto max-w-7xl flex justify-center bg-white rounded-full w-40">
                <a href="{{ route('home') }}"><img src="https://i.ibb.co/jzMJMX5/pokebits-OIG-removebg-preview.png" alt="Pokébit" class="w-40 h-40"></a>
            </div>
        </header>
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
