@extends('layouts.app')

@section('title', 'Création d\'une Absence')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Création d'une absence</h1>

        <form action="{{ route('absence.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="mb-4">
                    <label for="motif_id" class="block text-sm font-medium text-gray-600 mb-1">Motif de l'absence :</label>
                    <select name="motif_id" id="motif_id" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                        @forelse ($motifs as $motif)
                            <option value="{{ $motif->id }}">{{ $motif->libelle }}</option>
                        @empty
                            <option class="bg-yellow-100 text-center" disabled>Aucun motif n'a été trouvé</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-600 mb-1">Utilisateur :</label>
                    <select name="user_id" id="user_id" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                        @forelse ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->prenom . ' ' . $user->nom }}</option>
                        @empty
                            <option class="bg-yellow-100 text-center" disabled>Aucun utilisateur n'a été trouvé</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-4">
                    <label for="date_debut" class="block text-sm font-medium text-gray-600 mb-1">Date de début :</label>
                    <input type="date" name="date_debut" id="date_debut" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                </div>

                <div class="mb-4">
                    <label for="date_fin" class="block text-sm font-medium text-gray-600 mb-1">Date de fin :</label>
                    <input type="date" name="date_fin" id="date_fin" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                    Créer
                </button>
            </div>
        </form>
    </div>
@endsection
