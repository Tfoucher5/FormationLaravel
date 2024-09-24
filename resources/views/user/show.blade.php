@extends('layouts.app')

@section('title', __('user_absence'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">{{ __('absence_of') }} {{ $user->prenom }} {{ $user->nom }}</h1>
    <div class="mb-3">
        <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-2 font-bold text-center text-gray-800" href="{{ url('/user') }}">{{ __('back') }}</a>
    </div>
    <ul class="space-y-4">
        @forelse ($absences as $absence)
            <li class="bg-gray-50 p-5 rounded-lg shadow-md">
                <div class="mb-2">
                    <strong>{{ __('start_date') }} :</strong>
                    <span class="text-gray-700">{{ \Carbon\Carbon::parse($absence->date_debut)->format('d/m/Y') }}</span>
                </div>
                <div class="mb-2">
                    <strong>{{ __('end_date') }} :</strong>
                    <span class="text-gray-700">{{ \Carbon\Carbon::parse($absence->date_fin)->format('d/m/Y') }}</span>
                </div>
                <div>
                    <strong>{{ __('reason') }} :</strong>
                    <span class="text-gray-700">{{ $absence->motif->libelle }}</span>
                </div>
            </li>
        @empty
            <div class="bg-yellow-100 p-5 rounded-lg text-center">
                {{ __('no_absence_found') }}
            </div>
        @endforelse
    </ul>
</div>
@endsection
