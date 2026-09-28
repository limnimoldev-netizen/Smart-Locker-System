@extends('layouts.app')

@section('title', 'Location Details')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-blue-200">Location details</p>
                    <h1 class="mt-1 text-xl font-semibold">{{ $location->name ?? 'Location' }}</h1>
                </div>
                <i class="fa-solid fa-location-dot text-2xl text-blue-200" aria-hidden="true"></i>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <dl class="grid gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-sm text-slate-500">Address</dt>
                    <dd class="mt-1 font-medium text-slate-900">{{ $location->address }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Status</dt>
                    <dd class="mt-1 font-medium capitalize text-slate-900">{{ $location->status }}</dd>
                </div>
               
            </dl>

            <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-200 pt-5">
                @if ($location->map_url)
                    <a href="{{ $location->map_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                        <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i>
                        Open map
                    </a>
                @endif
                <a href="{{ route('locations.index') }}" class="inline-flex items-center rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Back to locations</a>
            </div>
        </section>
    </div>
@endsection
