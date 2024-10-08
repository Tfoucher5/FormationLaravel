@extends('layouts.app')
@section('title')
    {{ __('user_list') }}
@endsection
@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">{{ __('my_absences') }}</h1>
    <div class="mb-3">
        <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800"
            href="{{ url('absence') }}">{{ __('back') }}</a>
        @can('create-absence')
            <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800"
                href="{{ route('absence.create') }}">{{ __('create') }}</a>
        @endcan
    </div>
    <ul class="space-y-4">
        @foreach ($absences as $absence)
            <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-lg font-semibold">{{ __('absent_user') }} : <span
                            class="text-gray-700">{{ $absence->user->prenom . ' ' . $absence->user->nom }}</span></p>
                    <p class="text-lg font-semibold">{{ __('absence_reason') }} : <span
                            class="text-gray-700">{{ $absence->motif->libelle }}</span></p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('absence.show', $absence->id) }}"
                        class="text-blue-500 hover:text-blue-700 font-semibold border border-blue-500 rounded-lg p-1">
                        {{ __('view_details') }}
                    </a>
                    @if ($absence->is_verified == 0 || auth()->user()->isA('admin'))
                        @can('edit-absence')
                            <a class="bg-blue-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white"
                                href="{{ route('absence.edit', $absence->id) }}">{{ __('edit') }}</a>
                        @endcan
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
