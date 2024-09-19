@extends('layouts.app')
@section('title')
Détails de l'Absence
@endsection
@section('content')
<div class="flex justify-center ">
    <div class="text-center">
        <h1 class="text-6xl mb-10">Absence n°{{ $absences->id }}</h1>
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
                <p><strong>Date de Début :</strong> {{ $absences->date_debut }}</p>
            </div>
            <div>
                <p><strong>Date de Fin :</strong> {{ $absences->date_fin }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
