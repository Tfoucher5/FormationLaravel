@extends('layouts.app')

@section('title', 'Modification d\'un Motif')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">Modification d'un Motif</h1>

        <form action="{{ route('motif.update', $motif->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="libelle" class="block text-sm font-medium text-gray-600">Nom du motif :</label>
                <input type="text" name="libelle" id="libelle" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nom du motif" value="{{ old('libelle', $motif->libelle) }}" required>
                @error('libelle')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <span class="block text-sm font-medium text-gray-600">Accessible aux salariés :</span>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_accessible_salarie" value="1" class="form-radio" {{ old('is_accessible_salarie', $motif->is_accessible_salarie) == '1' ? 'checked' : '' }}>
                        <span class="ml-2">Oui</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_accessible_salarie" value="0" class="form-radio" {{ old('is_accessible_salarie', $motif->is_accessible_salarie) == '0' ? 'checked' : '' }}>
                        <span class="ml-2">Non</span>
                    </label>
                </div>
                @error('option')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Modifier
                </button>
                <div class="flex justify-end">
                    <a class="w-full mt-3 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" href="{{ route('motif.index') }}">Retour</a>
                </div>
            </div>
        </form>
    </div>
@endsection
