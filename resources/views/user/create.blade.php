@extends('layouts.app')

@section('title', 'Création d\'un Utilisateur')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">Création d'un Motif</h1>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-600">Prénom de l'utilisateur :</label>
                    <input type="text" name="prenom" id="prenom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Prénom de 'utilisateur" required>
                <label for="nom" class="block text-sm font-medium text-gray-600">Nom de l'utilisateur :</label>
                    <input type="text" name="nom" id="nom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nom de l'utilisateur" required>
                <label for="mail" class="block text-sm font-medium text-gray-600">Mail de l'utilisateur :</label>
                    <input type="mail" name="email" id="email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Mail de l'utilisateur" required>
                <label for="passwordd" class="block text-sm font-medium text-gray-600">Mot de Passe de l'utilisateur :</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Mot de passe de l'utilisateur" required>
            </div>
            <div class="text-center">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Créer
                </button>
            </div>
        </form>
    </div>
@endsection
