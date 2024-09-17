<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Liste des Absences</h1>
        <div class="mb-3">
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ url('/')}}">Retour</a>
        </div>
        <ul class="space-y-4">
            @foreach ($absences as $absence)
                <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <p class="text-lg font-semibold">Numéro de l'absence : <span class="text-gray-700">{{ $absence->id }}</span></p>
                        <p class="text-lg font-semibold">Motif de l'absence : <span class="text-gray-700">{{ $absence->motif->libelle }}</span></p>
                    </div>
                    <div>
                        <a href="{{ route('absence.show', $absence->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                            Voir détail
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
