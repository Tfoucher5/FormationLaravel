@extends('layouts.app')
@section('title')
Liste des utilisateurs
@endsection
@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Liste des Absences</h1>
        <div class="mb-3">
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ url('/')}}">Retour</a>
            @can('create-absence')
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ route('absence.create')}}">Créer</a>
            @endcan
        </div>
        <ul class="space-y-4">
            @foreach ($absences as $absence)
                <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <p class="text-lg font-semibold">Numéro de l'absence : <span class="text-gray-700">{{ $absence->id }}</span></p>
                        <p class="text-lg font-semibold">Utilisateur absent : <span class="text-gray-700">{{ $absence->user->prenom . ' ' . $absence->user->nom }}</span></p>
                        <p class="text-lg font-semibold">Motif de l'absence : <span class="text-gray-700">{{ $absence->motif->libelle }}</span></p>
                    </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('absence.show', $absence->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold border border-blue-500 rounded-lg p-1">
                                Voir détail
                            </a>
                            @can('edit-absence')
                            <a class="bg-blue-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white" href="{{ route('absence.edit', $absence->id) }}">Modifier</a>
                            @endcan
                            @can('delete-absence')
                            <form action="{{ route('absence.destroy', $absence->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white">Supprimer</button>
                            </form>
                            @endcan
                        </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
