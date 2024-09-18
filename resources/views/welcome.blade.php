<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <h1 class="flex lg:justify-center lg:col-start-2 mt-7 text-9xl text-red-600">Formation Laravel</h1>
        <div class="flex lg:justify-center lg:col-start-2 mt-48">
            <a class="text-9xl border-2 mr-2 border-red-600 text-red-600 p-10 inline-block rounded-lg hover:bg-red-600 hover:text-white" href="{{ route('absence.index') }}">
                Absences
            </a>
            <a class="text-9xl border-2 mr-2 border-red-600 text-red-600 p-10 inline-block rounded-lg hover:bg-red-600 hover:text-white" href="{{route('user.index')}}">
                Utilisateurs
            </a>
            <a class="text-9xl border-2 border-red-600 text-red-600 p-10 inline-block rounded-lg hover:bg-red-600 hover:text-white" href="{{route('motif.index')}}">
                Motifs
            </a>
        </div>
    </body>
</html>
