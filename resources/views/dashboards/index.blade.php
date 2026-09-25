@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6">
        <section class="rounded-lg bg-[#1E3A8A] px-5 py-6 text-white shadow-md sm:px-8">
            <p class="text-sm font-medium uppercase tracking-wide text-blue-200">Staff overview</p>
            <h1 class="mt-1 text-2xl font-semibold">Smart Locker Dashboard</h1>
            <p class="mt-1 text-sm text-blue-100">Monitor locker availability, usage, locations, and maintenance.</p>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('locations.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-blue-300">
                <p class="text-sm text-slate-500">Locations</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalLocations }}</p>
                <p class="mt-1 text-xs text-slate-500">Registered locker sites</p>
            </a>
            <a href="{{ route('lockers.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-blue-300">
                <p class="text-sm text-slate-500">Available lockers</p>
                <p class="mt-2 text-3xl font-semibold text-emerald-600">{{ $availableLockers }}</p>
                <p class="mt-1 text-xs text-slate-500">Of {{ $totalLockers }} total lockers</p>
            </a>
            <a href="{{ route('user.usage.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-blue-300">
                <p class="text-sm text-slate-500">Active usage</p>
                <p class="mt-2 text-3xl font-semibold text-blue-700">{{ $activeUsages }}</p>
                <p class="mt-1 text-xs text-slate-500">Lockers currently in use</p>
            </a>
            <a href="{{ route('maintenance.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-blue-300">
                <p class="text-sm text-slate-500">Open maintenance</p>
                <p class="mt-2 text-3xl font-semibold text-amber-600">{{ $pendingMaintenance }}</p>
                <p class="mt-1 text-xs text-slate-500">Pending or in progress</p>
            </a>
        </section>

        <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Locker status</h2>
                        <p class="text-sm text-slate-500">Current system-wide availability</p>
                    </div>
                    <a href="{{ route('lockers.index') }}" class="text-sm font-semibold text-blue-700 hover:underline">Manage lockers</a>
                </div>
                <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                    <div class="rounded-lg bg-emerald-50 p-4"><p class="text-2xl font-semibold text-emerald-700">{{ $availableLockers }}</p><p class="mt-1 text-xs text-emerald-800">Available</p></div>
                    <div class="rounded-lg bg-blue-50 p-4"><p class="text-2xl font-semibold text-blue-700">{{ $inUseLockers }}</p><p class="mt-1 text-xs text-blue-800">In use</p></div>
                    <div class="rounded-lg bg-orange-50 p-4"><p class="text-2xl font-semibold text-orange-700">{{ $maintenanceLockers }}</p><p class="mt-1 text-xs text-orange-800">Maintenance</p></div>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Recent maintenance</h2>
                        <p class="text-sm text-slate-500">Latest locker issues</p>
                    </div>
                    <a href="{{ route('maintenance.index') }}" class="text-sm font-semibold text-blue-700 hover:underline">View all</a>
                </div>
                <div class="mt-4 divide-y divide-slate-200">
                    @forelse ($recentMaintenance as $maintenance)
                        <a href="{{ route('maintenance.show', $maintenance) }}" class="flex items-center justify-between gap-3 py-3 hover:bg-slate-50">
                            <div class="min-w-0"><p class="truncate text-sm font-medium text-slate-900">Locker #{{ $maintenance->locker_id }}</p><p class="truncate text-xs text-slate-500">{{ $maintenance->description }}</p></div>
                            <span class="shrink-0 rounded-full bg-amber-50 px-2 py-1 text-xs text-amber-700">{{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}</span>
                        </a>
                    @empty
                        <p class="py-6 text-center text-sm text-slate-500">No maintenance requests yet.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="flex flex-wrap items-center justify-between gap-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <div><h2 class="font-semibold text-slate-900">User management</h2><p class="text-sm text-slate-500">{{ $totalUsers }} registered customer accounts</p></div>
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-800"><i class="fa-solid fa-users" aria-hidden="true"></i>Manage users</a>
        </section>
    </div>
@endsection

