@extends('layouts.app')
@section('title')
Absences de l'Utilisateur
@endsection
@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Absences de {{ $user->prenom }} {{ $user->nom }}</h1>
        <div class="mb-3">
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-2 font-bold text-center text-gray-800" href="{{ url('/user')}}">Retour</a>
        </div>
        <ul class="space-y-4">
            @forelse ($absences as $absence)
                <li class="bg-gray-50 p-5 rounded-lg shadow-md">
                    <div class="mb-2">
                        <strong>Date de début :</strong>
                        <span class="text-gray-700">{{ \Carbon\Carbon::parse($absence->date_debut)->format('d/m/Y') }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Date de fin :</strong>
                        <span class="text-gray-700">{{ \Carbon\Carbon::parse($absence->date_fin)->format('d/m/Y') }}</span>
                    </div>
                    <div>
                        <strong>Motif :</strong>
                        <span class="text-gray-700">{{ $absence->motif->libelle }}</span>
                    </div>
                </li>
            @empty
                <div class="bg-yellow-100 p-5 rounded-lg text-center">
                    {{ __('Aucune absence recensée pour cet utilisateur') }}
                </div>
            @endforelse
        </ul>
    </div>
@endsection
