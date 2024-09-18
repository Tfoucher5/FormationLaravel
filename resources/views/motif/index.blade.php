@extends('layouts.app')
@section('title')
Liste des Motifs
@endsection
@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">Liste des Motifs</h1>
    <div class="mb-5">
        <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ url('/')}}">Retour</a>
        <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ route('motif.create')}}">Créer</a>
    </div>
    <ul class="space-y-4">
        @foreach ($motifs as $motif)
            <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div class="flex-1">
                    <p class="text-lg font-semibold">ID : <span class="text-gray-700">{{ $motif->id }}</span></p>
                    <p class="text-lg font-semibold">Libellé : <span class="text-gray-700">{{ $motif->libelle }}</span></p>
                </div>
                <div class="flex space-x-2">
                    <a class="bg-blue-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white" href="{{ route('motif.edit', $motif->id) }}">Modifier</a>
                    <form action="{{ route('motif.destroy', $motif->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce motif ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
