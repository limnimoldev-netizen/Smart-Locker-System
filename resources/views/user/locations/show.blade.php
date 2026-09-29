@extends('layouts.app')

@section('content')
<div class=" mx-auto max-w-6xl space-y-6 bg-[#F8F9FA] sm:space-y-8 min-h-screen bg-white flex flex-col">

    {{-- Header --}}
    <header class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5">
        <a href="{{ url()->previous() }}" class="text-white">
             
        </a>
        <h1 class="text-lg sm:text-2xl font-bold">Location Details</h1>
    </header>

    {{-- Map placeholder --}}
    <div class="bg-gradient-to-b from-blue-100 to-blue-50 h-40 sm:h-64 flex items-center justify-center flex-shrink-0">
        <svg class="w-8 h-8 sm:w-12 sm:h-12 text-blue-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
            <circle cx="12" cy="10" r="3"/>
        </svg>
    </div>

    <div class="px-5 sm:px-10 py-5 sm:py-8 flex-1">
        <div class="max-w-5xl mx-auto w-full">

            <div class="sm:flex sm:items-start sm:justify-between sm:gap-8">
                <div>
                    <h2 class="text-xl sm:text-3xl font-bold text-gray-900">{{ $location->name }}</h2>
                    <p class="text-sm sm:text-base text-gray-500 mt-1">{{ $location->address }}</p>
                </div>

                
            </div>

            {{-- Locker status --}}
            <p class="text-sm sm:text-base font-semibold text-gray-700 mt-6 sm:mt-8 mb-3">Locker status</p>
            <div class="grid grid-cols-3 gap-3 sm:gap-4 sm:max-w-xl">
                <div class="bg-green-100 rounded-xl py-4 sm:py-6 text-center">
                    <p class="text-2xl sm:text-4xl font-bold text-green-700">{{ $available }}</p>
                    <p class="text-xs sm:text-sm text-green-700">Available</p>
                </div>
                <div class="bg-red-100 rounded-xl py-4 sm:py-6 text-center">
                    <p class="text-2xl sm:text-4xl font-bold text-red-600">{{ $inUse }}</p>
                    <p class="text-xs sm:text-sm text-red-600">In Use</p>
                </div>
                <div class="bg-orange-100 rounded-xl py-4 sm:py-6 text-center">
                    <p class="text-2xl sm:text-4xl font-bold text-orange-600">{{ $maintenance }}</p>
                    <p class="text-xs sm:text-sm text-orange-600">Maintenance</p>
                </div>
            </div>

            {{-- View Lockers button --}}
            <a href="{{ route('user.locations.lockers', $location) }}" class="block sm:inline-block text-center bg-blue-900 text-white font-semibold rounded-2xl py-4 px-10 mt-6 hover:bg-blue-950 transition-colors">
                View Lockers
            </a>
        </div>
    </div>
</div>
@endsection