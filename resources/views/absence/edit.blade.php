@extends('layouts.app')

@section('title', __('update_absence'))

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">{{ __('update_absence') }}</h1>

        <form action="{{ route('absence.update', $absence->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Assurez-vous que le formulaire utilise la méthode PUT pour une mise à jour -->

            <div class="space-y-4">
                <div class="mb-4">
                    <label for="motif_id" class="block text-sm font-medium text-gray-600 mb-1">{{ __('absence_reason') }} :</label>
                    <select name="motif_id" id="motif_id" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                        @foreach ($motifs as $motif)
                            <option value="{{ $motif->id }}" {{ old('motif_id', $absence->motif_id) == $motif->id ? 'selected' : '' }}>
                                {{ $motif->libelle }}
                            </option>
                        @endforeach
                    </select>
                    @error('motif_id')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-600 mb-1">{{ __('user') }} :</label>
                    <select name="user_id" id="user_id" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $absence->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->prenom . ' ' . $user->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_debut" class="block text-sm font-medium text-gray-600 mb-1">{{ __('start_date') }} :</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $absence->date_debut) }}" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                    @error('date_debut')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date_fin" class="block text-sm font-medium text-gray-600 mb-1">{{ __('end_date') }} :</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $absence->date_fin) }}" class="block w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                    @error('date_fin')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                    {{ __('update') }}
                </button>
                <div class="flex justify-end">
                    <a class="mt-3 w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline"
                        href="{{ route('absence.index') }}">{{ __('back') }}</a>
                </div>
            </div>
        </form>
    </div>
@endsection
