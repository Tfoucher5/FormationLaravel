@extends('layouts.app')
@section('title')
    Gestion des Absences
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen text-center">
        <h1 class="text-9xl text-red-600 mb-12">Gestion des Absences</h1>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                href="{{ route('absence.index') }}">
                Absences
            </a>
            <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                href="{{ route('user.index') }}">
                Utilisateurs
            </a>
            <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                href="{{ route('motif.index') }}">
                Motifs
            </a>
        </div>
    </div>
@endsection
