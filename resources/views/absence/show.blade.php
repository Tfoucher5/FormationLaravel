<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'Absence</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
        <h1 class="text-6xl mb-10">Absence n°{{ $absence->id }}</h1>
        <div class="mb-3">
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-2 font-bold text-center text-gray-800" href="{{ url('/absence')}}">Retour</a>
        </div>
        <div class="border border-black max-w-xl p-5 mt-10 bg-white shadow-md rounded-lg">
            <div class="mb-4">
                <p><strong>Utilisateur :</strong> {{ $user->prenom }} {{ $user->nom }}</p>
            </div>
            <div class="mb-4">
                <p><strong>Motif :</strong> {{ $motif->Libelle }}</p>
            </div>
            <div class="mb-4">
                <p><strong>Date de Début :</strong> {{ $absence->date_debut }}</p>
            </div>
            <div>
                <p><strong>Date de Fin :</strong> {{ $absence->date_fin }}</p>
            </div>
        </div>
    </div>
</body>
</html>
