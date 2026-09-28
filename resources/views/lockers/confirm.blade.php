@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 relative flex flex-col">

    {{-- Dimmed background content --}}
    <div class="opacity-30 flex-1 pointer-events-none select-none">
        <header class="bg-gradient-to-br from-blue-800 via-blue-900 to-indigo-950 text-white px-5 sm:px-10 lg:px-16 pt-6 pb-5 flex items-center gap-4">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            <h1 class="text-lg sm:text-2xl font-bold">Locker {{ $locker->locker_number }}</h1>
        </header>

        <div class="px-5 sm:px-10 lg:px-16 py-6 sm:py-10">
            <div class="bg-white border border-gray-100 rounded-2xl p-8 sm:p-14 text-center shadow-sm">
                <svg class="w-10 h-10 sm:w-14 sm:h-14 mx-auto text-gray-400 mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/>
                </svg>
                <p class="font-bold text-gray-700 sm:text-lg">Available</p>
                <p class="text-sm text-gray-500">Ready to reserve</p>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-4 sm:p-6 mt-4 shadow-sm">
                <p class="text-xs sm:text-sm text-gray-500">Location</p>
                <p class="font-bold text-gray-700 sm:text-lg">{{ $location->name }} · Locker {{ $locker->locker_number }}</p>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="fixed inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4 z-50">
        <div class="bg-white rounded-t-3xl sm:rounded-3xl p-6 sm:p-8 shadow-2xl w-full sm:max-w-md">
            <div class="w-10 h-1.5 bg-gray-200 rounded-full mx-auto mb-5 sm:hidden"></div>

            <h2 class="text-lg sm:text-xl font-bold text-gray-900 text-center">Use this locker?</h2>
            <p class="text-sm sm:text-base text-gray-500 text-center mt-2">
                Are you sure you want to use Locker {{ $locker->locker_number }} at {{ $location->name }}? It will be reserved under your account.
            </p>

            <form method="POST" action="/lockers/{{ $locker->id }}/confirm" class="mt-5">
                @csrf
                <button type="submit" class="w-full bg-blue-900 text-white font-bold rounded-2xl py-4 hover:bg-blue-950 transition-colors">
                    Confirm & Unlock
                </button>
            </form>

            <a href="{{ url()->previous() }}" class="block text-center border border-gray-200 rounded-2xl py-4 mt-3 font-semibold text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </div>
</div>
@endsection