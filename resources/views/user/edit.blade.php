@extends('layouts.app')

@section('title', 'Modification d\'un Utilisateur')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">Modification d'un User</h1>

        <form action="{{ route('motif.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="libelle" class="block text-sm font-medium text-gray-600">Nom du user :</label>
                <input type="text" name="libelle" id="libelle" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nom du motif" value="{{ old('libelle', $motif->libelle) }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Modifier
                </button>
            </div>
        </form>
    </div>
@endsection
