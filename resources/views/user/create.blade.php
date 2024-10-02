@extends('layouts.app')

@section('title', __('user_create'))

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-700">{{ __('user_create') }}</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-600">{{ __('user_firstname') }} :</label>
            <input type="text" name="prenom" id="prenom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('user_firstname') }}" required>
        </div>

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-600">{{ __('user_lastname') }} :</label>
            <input type="text" name="nom" id="nom" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('user_lastname') }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">{{ __('user_mail') }} :</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('user_mail') }}" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-600">{{ __('password') }} :</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('password') }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('create') }}
            </button>
        </div>
    </form>
</div>
@endsection
