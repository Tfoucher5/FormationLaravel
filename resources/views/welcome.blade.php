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

<body>
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

            <!-- Navigation (login/register) -->
            @if (Route::has('login'))
                <nav class="flex justify-end py-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif

            <!-- Main content -->
            <div class="flex flex-col items-center justify-center min-h-screen text-center">
                @if (session('message'))
                    <div class="text-red-600 mb-4">{{ session()->pull('message') }}</div>
                @endif
                <h1 class="text-9xl text-red-600 mb-12">Gestion des Absences</h1>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @can('view-absence')
                        <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                            href="{{ route('absence.index') }}">
                            Absences
                        </a>
                    @endcan
                    @can('view-user')
                        <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                            href="{{ route('user.index') }}">
                            Utilisateurs
                        </a>
                    @endcan
                    @can('view-motif')
                        <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                            href="{{ route('motif.index') }}">
                            Motifs
                        </a>
                    @endcan
                </div>
            </div>

        </div>
    </div>
</body>

</html>
