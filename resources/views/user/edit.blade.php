@extends('layouts.app')

@section('title', __('edit_user'))

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">{{ __('edit_user') }}</h1>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-600">{{ __('user_firstname') }} :</label>
            <input type="text" name="prenom" id="prenom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('user_firstname') }}" value="{{ old('prenom', $user->prenom) }}" required>
        </div>

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-600">{{ __('user_lastname') }} :</label>
            <input type="text" name="nom" id="nom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('user_lastname') }}" value="{{ old('nom', $user->nom) }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">{{ __('user_name') }} :</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('user_mail') }}" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-600">{{ __('password') }} :</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('password') }}">
        </div>

        <div class="text-center">
            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('update') }}
            </button>
        </div>
    </form>
</div>
@endsection
