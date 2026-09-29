@extends('layouts.app')
@section('title', 'My Locker')
@section('content')



<div>
    <section class=" mx-auto max-w-6xl space-y-6  sm:space-y-8 rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600">
                    <i class="fa-solid fa-box" aria-hidden="true"></i>
                </span>
                <div>
                    <h1 class="text-xl font-semibold">My Locker</h1>
                    <p class="text-sm text-blue-200 sm:text-base">Lockers you are using right now</p>
                </div>
            </div>
            <a href="{{ route('user.locations.index') }}" class="inline-block mt-5 bg-blue-900 text-white font-semibold rounded-2xl px-8 py-3 hover:bg-blue-950 transition-colors">Find a Locker</a>
                </div>
    </section>

    <div class=" mx-auto max-w-6xl space-y-6 bg-[#F8F9FA] sm:space-y-8 mt-6 grid grid-cols-1 lg:grid-cols-2 gap-5">
        @forelse ($usages as $usage)
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Locker {{ $usage->locker->locker_number }}</h2>
                    <p class="text-sm text-gray-500">{{ $usage->locker->location->name }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 ring-1 ring-blue-200">In use</span>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-5 pt-5 border-t border-gray-100">
                <div>
                    <p class="text-xs text-gray-400">Access code</p>
                    <p class="font-mono font-bold text-lg text-gray-900">{{ $usage->access_code }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">Time elapsed</p>
                    <p class="font-bold text-lg text-gray-900 timer" data-started="{{ \Carbon\Carbon::parse($usage->started_at)->toIso8601String() }}">00:00:00</p>
                </div>
            </div>

            <form method="POST" action="{{ route('user.locker-usages.release', $usage) }}" class="mt-5">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-full bg-red-100 text-red-600 font-bold rounded-2xl py-3 hover:bg-red-200 transition-colors">Release Locker</button>
            </form>
        </div>
        @empty
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-10 text-center shadow-sm">
            <p class="text-lg font-bold text-gray-900">You are not using a locker</p>
            <p class="text-sm text-gray-500 mt-1">Find a location and pick a locker to get started.</p>
            <a href="{{ route('user.locations.index') }}" class="inline-block mt-5 bg-blue-900 text-white font-semibold rounded-2xl px-8 py-3 hover:bg-blue-950 transition-colors">Find a Locker</a>
        </div>
        @endforelse
    </div>
</div>

<script>
    const pad = n => String(n).padStart(2, '0');

    function tick() {
        document.querySelectorAll('.timer').forEach(el => {
            const ms = Date.now() - new Date(el.dataset.started).getTime();
            const s = Math.max(0, Math.floor(ms / 1000));
            el.textContent = `${pad(Math.floor(s / 3600))}:${pad(Math.floor((s % 3600) / 60))}:${pad(s % 60)}`;
        });
    }
    tick();
    setInterval(tick, 1000);
</script>
@endsection