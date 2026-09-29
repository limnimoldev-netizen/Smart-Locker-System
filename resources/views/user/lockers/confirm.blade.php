@extends('layouts.app')

@section('content')
<div class=" mx-auto max-w-6xl space-y-6 bg-[#F8F9FA] sm:space-y-8 min-h-screen bg-gray-100 relative flex flex-col">

    {{-- Dimmed background content --}}
    <div class="opacity-30 flex-1 pointer-events-none select-none">
        <header class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5">
        
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

   {{-- Confirm card --}}
    <div class="px-5 sm:px-10 lg:px-16 py-6 sm:py-10 absolute inset-0 flex items-center justify-center">
        <div class="max-w-md mx-auto bg-white rounded-3xl p-6 sm:p-8 shadow-lg border border-gray-100">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 text-center">Use this locker?</h2>
            <p class="text-sm sm:text-base text-gray-500 text-center mt-2">
                Are you sure you want to use Locker {{ $locker->locker_number }} at {{ $location->name }}? It will be reserved under your account.
            </p>

            <form method="POST" action="{{ route('user.lockers.confirm.store', $locker) }}" class="mt-5">
                @csrf
                <button type="submit" class="w-full bg-blue-900 text-white font-bold rounded-2xl py-4 hover:bg-blue-950 transition-colors">
                    Confirm &amp; Unlock
                </button>
            </form>

            <a href="{{ url()->previous() }}" class="block text-center border border-gray-200 rounded-2xl py-4 mt-3 font-semibold text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
        </div>
    </div>
</div>

</div>
@endsection