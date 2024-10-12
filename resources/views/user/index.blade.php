@extends('layouts.app')

@section('title', __('user_list'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    @if (session('message'))
        <p class="bg-orange-500 rounded-lg border border-black-850 p-1 mb-5 font-bold text-center text-white">
            {{ session()->pull('message') }}
        </p>
    @endif
    <h1 class="text-3xl font-bold mb-2 text-center text-gray-800">{{ __('user_list') }}</h1>
    <p class="text-xl mb-4 text-center">{{ __('Nombre d\'utilisateurs :') }} {{ $users->count() }}</p>
    <div class="mb-5">
        <a class="bg-gray-300 w-min rounded-lg border border-black-850 p-1 font-bold text-center text-gray-800" href="{{ url('/') }}">{{ __('back') }}</a>
    </div>
    <ul class="space-y-4">
        @foreach ($users as $user)
            <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-lg font-semibold">{{ __('firstname') }} : <span class="text-gray-700">{{ $user->prenom }}</span></p>
                    <p class="text-lg font-semibold">{{ __('lastname') }} : <span class="text-gray-700">{{ $user->nom }}</span></p>
                </div>
                <div class="flex space-x-2">
                    @can('view-user')
                        <a href="{{ route('user.show', $user->id) }}"
                           class="text-blue-500 hover:text-blue-700 font-semibold border border-blue-500 rounded-lg p-1">{{ __('view_user') }}</a>
                    @endcan
                    @can('edit-user')
                        <a class="bg-blue-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white"
                           href="{{ route('user.edit', $user->id) }}">{{ __('update') }}</a>
                    @endcan
                    @can('delete-user')
                        @if ($user->trashed())
                            <a class="bg-orange-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white"
                               href="{{ route('user.restore', $user->id) }}">{{ __('restore') }}</a>
                        @else
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('{{ __('delete_confirm') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 rounded-lg border border-black-850 p-1 font-bold text-center text-white">{{ __('delete') }}</button>
                            </form>
                        @endif
                    @endcan
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
