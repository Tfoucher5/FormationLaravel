@extends('layouts.app')
@section('title')
Liste des utilisateurs
@endsection
@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">Liste des Utilisateurs</h1>
        <p class="text-xl mb-4 text-center">Nombre d'utilisateurs : {{ $users->count() }}</p>
        <div class="mb-5">
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ url('/')}}">Retour</a>
        </div>
        <ul class="space-y-4">
            @foreach ($users as $user)
                <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <p class="text-lg font-semibold">Prénom : <span class="text-gray-700">{{ $user->prenom }}</span></p>
                        <p class="text-lg font-semibold">Nom : <span class="text-gray-700">{{ $user->nom }}</span></p>
                    </div>
                    <div>
                        <a href="{{ route('user.show', $user->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                            Voir absences
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
