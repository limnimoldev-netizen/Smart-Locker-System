@extends('layouts.app')

@section('title', 'Home users')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Welcome Banner -->
    <div class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5 p-6 text-white shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name ?? 'User' }}! </h1>
            <p class="text-blue-100 text-sm mt-1">Manage your active locker bookings and explore available hubs near you.</p>
        </div>
       
    </div>

    <!-- Overview Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#1E3A8A] flex items-center justify-center text-xl">
                <i class="fa-solid fa-box"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Active Status</p>
                <p class="text-base font-bold text-gray-900 mt-0.5">
                    {{ isset($activeUsage) && $activeUsage ? '1 Active Rental' : 'No Active Locker' }}
                </p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-key"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Available Lockers</p>
                <p class="text-base font-bold text-gray-900 mt-0.5">{{ $availableLockersCount ?? 0 }} Ready</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Locker Stations</p>
                <p class="text-base font-bold text-gray-900 mt-0.5">{{ $locationsCount ?? 0 }} Locations</p>
            </div>
        </div>
    </div>

    <!-- Main Section: Active Rental or Quick Booking -->
    @if(isset($activeUsage) && $activeUsage)
        <!-- Active Locker Spotlight Card -->
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-6 relative overflow-hidden">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                    <h2 class="text-lg font-bold text-gray-900">Current Active Locker</h2>
                </div>
                <a href="{{ url('/user/lockers') }}" class="text-xs font-semibold text-[#1E3A8A] hover:underline">View Details &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                <div>
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Locker Number</span>
                    <p class="text-xl font-bold text-gray-900 mt-1">Locker #{{ $activeUsage->locker->locker_number ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $activeUsage->locker->location->name ?? 'Unknown Location' }}</p>
                </div>

                <div>
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Passcode Key</span>
                    <div class="bg-blue-50 border border-blue-100 rounded-lg px-3 py-1.5 w-fit mt-1">
                        <span class="font-mono text-lg font-bold text-[#1E3A8A] tracking-widest">{{ $activeUsage->access_code ?? '------' }}</span>
                    </div>
                </div>

                <div class="flex items-center md:justify-end">
                    <a href="{{ url('/user/lockers') }}" class="w-full md:w-auto px-4 py-2.5 bg-[#1E3A8A] text-white text-sm font-semibold rounded-xl hover:bg-blue-900 transition text-center">
                        Manage Rental
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Quick Action Prompt when no locker active -->
        <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-1 text-center md:text-left">
                <h3 class="text-lg font-bold text-gray-900">Need a secure place for your items?</h3>
                <p class="text-sm text-gray-500">Browse nearby smart locker hubs and reserve your space instantly.</p>
            </div>
            <a href="{{ url('/locations/search') }}" class="px-6 py-3 bg-[#1E3A8A] text-white font-semibold text-sm rounded-xl hover:bg-blue-900 transition shrink-0">
                Reserve a Locker Now
            </a>
        </div>
    @endif

    <!-- Recent Activity History -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Recent Usage Activity</h3>
            <a href="{{ url('/user/history') }}" class="text-xs font-semibold text-[#1E3A8A] hover:underline">View All</a>
        </div>

        @if(isset($recentUsages) && count($recentUsages) > 0)
            <div class="divide-y divide-gray-100">
                @foreach($recentUsages as $usage)
                    <div class="py-3 flex items-center justify-between text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center">
                                <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Locker #{{ $usage->locker->locker_number ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">{{ $usage->locker->location->name ?? 'Location' }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">
                            {{ $usage->ended_at ? \Carbon\Carbon::parse($usage->ended_at)->diffForHumans() : 'Completed' }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 py-4 text-center">No past locker rentals recorded yet.</p>
        @endif
    </div>

</div>
@endsection