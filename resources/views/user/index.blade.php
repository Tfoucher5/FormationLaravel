@extends('layouts.app')
@section('title')
    Liste des utilisateurs
@endsection
@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        @if (session('message'))
            <p class="bg-orange-500 rounded-lg border border-black-850 p-1 mb-5  font-bold text-center text-white">
                {{ session()->pull('message') }}
            </p>
        @endif
        <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">Liste des Utilisateurs</h1>
        <p class="text-xl mb-4 text-center">Nombre d'utilisateurs : {{ $users->count() }}</p>
        <div class="mb-5">
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800"
                href="{{ url('/') }}">Retour</a>
        </div>
        <ul class="space-y-4">
            @foreach ($users as $user)
                <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <p class="text-lg font-semibold">Prénom : <span class="text-gray-700">{{ $user->prenom }}</span></p>
                        <p class="text-lg font-semibold">Nom : <span class="text-gray-700">{{ $user->nom }}</span></p>
                    </div>
                    <div>

                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('user.show', $user->id) }}"
                            class="text-blue-500 hover:text-blue-700 font-semibold  border border-blue-500 rounded-lg p-1">Voir
                            absence(s)</a>

                        <a class="bg-blue-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white"
                            href="#{{-- route('user.edit', $user->id) --}}" >Modifier</a>
                        @if ($user->trashed())
                            <a class="bg-green-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white"
                                href="{{ route('user.restore', $user->id) }}">Restaurer</a>
                        @else
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white">Supprimer</button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
