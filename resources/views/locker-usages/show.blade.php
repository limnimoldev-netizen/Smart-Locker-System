@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col">

    {{-- Header --}}
    <header class="bg-gradient-to-b from-blue-900 to-blue-950 text-white px-5 sm:px-10 pt-6 pb-5 flex items-center gap-4 flex-shrink-0">
        <a href="/" class="text-white">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </a>
        <h1 class="text-lg sm:text-2xl font-bold">Locker Detail</h1>
    </header>

    <div class="px-5 sm:px-10 py-5 sm:py-8 flex-1">
        <div class="max-w-md sm:max-w-3xl mx-auto w-full">

            {{-- Status banner --}}
            <div class="bg-blue-50 text-blue-700 text-sm font-medium rounded-xl px-4 py-3 flex items-center gap-2 mb-5">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                Locker in Use — Locked Securely
            </div>

            <div class="sm:grid sm:grid-cols-2 sm:gap-5">

                {{-- Main card --}}
                <div class="bg-white rounded-2xl p-6 sm:p-8 text-center shadow-sm">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 sm:w-9 sm:h-9 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>
                        </svg>
                    </div>

                    <h2 class="text-lg sm:text-xl font-bold text-gray-900">Locker {{ $locker->locker_number }}</h2>
                    <p class="text-sm sm:text-base text-gray-600 mt-1">{{ $location->name }}</p>
                    <p class="text-xs sm:text-sm text-gray-400">Standard - Ground floor</p>

                    <hr class="my-4 border-gray-100">

                    <div class="flex justify-between text-left">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-400">Time Elapsed</p>
                            <p id="timeElapsed" class="font-bold text-gray-900 sm:text-lg">00:00:00</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs sm:text-sm text-gray-400">Time Remaining</p>
                            <p id="timeRemaining" class="font-bold text-red-500 sm:text-lg">00:00:00</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 sm:mt-0 flex flex-col">
                    {{-- Info box --}}
                    <div class="bg-white rounded-2xl p-4 sm:p-6 flex items-start gap-3 shadow-sm">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/>
                        </svg>
                        <p class="text-sm sm:text-base text-gray-600">Need to open the locker momentarily to retrieve an item? Select "Momentary Access" on the physical kiosk.</p>
                    </div>

                    {{-- Release button --}}
                    <form method="POST" action="/locker-usages/{{ $lockerUsage->id }}/release" class="mt-5 sm:mt-auto">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-red-100 text-red-600 font-bold rounded-2xl py-4 hover:bg-red-200 transition-colors">
                            Release Locker
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const startedAt = new Date("{{ $lockerUsage->started_at }}").getTime();
    const maxDurationMs = 1 * 60 * 60 * 1000; // example: 4 hour max session

    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function formatDuration(ms) {
        const totalSeconds = Math.max(0, Math.floor(ms / 1000));
        const h = Math.floor(totalSeconds / 3600);
        const m = Math.floor((totalSeconds % 3600) / 60);
        const s = totalSeconds % 60;
        return `${pad(h)}:${pad(m)}:${pad(s)}`;
    }

    function tick() {
        const now = Date.now();
        const elapsed = now - startedAt;
        const remaining = maxDurationMs - elapsed;

        document.getElementById('timeElapsed').textContent = formatDuration(elapsed);
        document.getElementById('timeRemaining').textContent = formatDuration(remaining);
    }

    tick();
    setInterval(tick, 1000);
</script>
@endsection