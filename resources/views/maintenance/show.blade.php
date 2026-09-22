@extends('layouts.app')

@section('title', 'Maintenance Request Details')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm text-blue-200">Maintenance request details</p>
                <h1 class="mt-1 text-xl font-semibold">Request #{{ $maintenance->id }}</h1>
            </div>
            <i class="fa-solid fa-wrench text-2xl text-blue-200" aria-hidden="true"></i>
        </div>
    </section>

    <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Locker</dt>
                <dd class="mt-1 font-medium text-slate-900">Locker #{{ $maintenance->locker_id }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Priority</dt>
                <dd class="mt-1 font-medium capitalize text-slate-900">{{ ucfirst($maintenance->priority) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Status</dt>
                <dd class="mt-1 font-medium capitalize text-slate-900">{{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Description</dt>
                <dd class="mt-1 font-medium text-slate-900">{{ $maintenance->description }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-200 pt-5">
            <a href="{{ route('maintenance.index') }}" class="inline-flex items-center rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Back to maintenance</a>
            <a href="{{ route('maintenance.edit', $maintenance) }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                <i class="fa-solid fa-pen-to-square text-xs" aria-hidden="true"></i>
                Edit request
            </a>
        </div>
    </section>
</div>
@endsection
