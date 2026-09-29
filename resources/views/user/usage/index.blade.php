@extends('layouts.app')

@section('title', 'My Usage')

@section('content')
    <h1 class="rounded-xl bg-[#1E3A8A] p-4 text-xl font-semibold text-white">Usage history</h1>

    <div class="mt-6 divide-y divide-gray-200 rounded-xl border border-gray-200 bg-white">
        @forelse ($usages as $usage)
            <article class="flex flex-col gap-2 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="font-semibold text-gray-900">Locker {{ $usage->locker->locker_number }}</h2>
                    <p class="text-sm text-gray-500">{{ $usage->locker->location->name }}</p>
                </div>
                <div class="text-sm text-gray-600 sm:text-right">
                    <p>{{ $usage->started_at ? \Illuminate\Support\Carbon::parse($usage->started_at)->format('M j, Y g:i A') : 'Start time unavailable' }}</p>
                    <p class="mt-1 capitalize">{{ str_replace('_', ' ', $usage->status) }}</p>
                </div>
            </article>
        @empty
            <p class="p-5 text-sm text-gray-500">No locker usage yet.</p>
        @endforelse
    </div>
@endsection
