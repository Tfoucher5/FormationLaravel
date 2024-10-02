@extends('layouts.app')

@section('title', __('welcome'))
@section('content')
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

            <!-- Main content -->
            <div class="flex flex-col items-center justify-center min-h-screen text-center">
                @if (session('message'))
                    <div class="bg-red-500 rounded-lg border border-black-850 p-1 mb-5 font-bold text-center text-white">{{ session()->pull('message') }}</div>
                @endif
                <h1 class="text-9xl text-red-600 mb-12">{{__('absence_manager')}}</h1>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @can('view-absence')
                        <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                            href="{{ route('absence.index') }}">
                            {{__('absences')}}
                        </a>
                    @endcan
                    @can('view-user')
                        <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                            href="{{ route('user.index') }}">
                            {{__('users')}}
                        </a>
                    @endcan
                    @can('view-motif')
                        <a class="text-6xl border-4 border-red-600 text-red-600 p-8 inline-block rounded-lg hover:bg-red-600 hover:text-white transition duration-300"
                            href="{{ route('motif.index') }}">
                            {{__('reasons')}}
                        </a>
                    @endcan
                </div>
            </div>

        </div>
    </div>
@endsection
