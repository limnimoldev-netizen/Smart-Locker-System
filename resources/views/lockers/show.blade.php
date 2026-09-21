@extends('layouts.app')

@section('title', 'Locker Details')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm text-blue-200">Locker details</p>
                <h1 class="mt-1 text-xl font-semibold">Locker #{{ $locker->id }}</h1>
            </div>
            <i class="fa-solid fa-box text-2xl text-blue-200" aria-hidden="true"></i>
        </div>
    </section>

    <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Type</dt>
                <dd class="mt-1 font-medium text-slate-900">{{ ucfirst($locker->type) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Status</dt>
                <dd class="mt-1 font-medium capitalize text-slate-900">{{ ucfirst(str_replace('_', ' ', $locker->status)) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Location</dt>
                <dd class="mt-1 font-medium text-slate-900">{{ $locker->location->name }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-200 pt-5">
            <a href="{{ route('lockers.index') }}" class="inline-flex items-center rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Back to lockers</a>
            <a href="{{ route('lockers.edit', $locker) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                <i class="fa-solid fa-pen-to-square text-xs" aria-hidden="true"></i>
                Edit locker
            </a>
        </div>
    </section>
</div>
@endsection
