@extends('layouts.app')

@section('title', 'Maintenance')

@section('content')
<div class="mx-auto max-w-6xl space-y-4 bg-[#F8F9FA] sm:space-y-6">

    <section class="rounded-lg bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:px-8 sm:py-5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600">
                    <i class="fa-solid fa-wrench" aria-hidden="true"></i>
                </span>
                <div>
                    <h1 class="text-xl font-semibold">Maintenance</h1>
                    <p class="text-sm text-blue-200 sm:text-base">Manage maintenance requests</p>
                </div>
            </div>
            <a href="{{ route('maintenance.create') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] sm:w-auto">
                <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                Add request
            </a>
        </div>
    </section>

    <section class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="flex items-center justify-between">
                <p class="text-sm text-slate-600 sm:text-base">Total requests</p>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700">   
                    <i class="fa-solid fa-wrench text-blue-700" aria-hidden="true"></i>
                </div>
            </div>
            <p class="mt-2 text-2xl text-[#1E3A8A] font-semibold">{{ $totalRequests ?? 0 }}</p>
            <p class="text-sm text-[#1E3A8A] sm:text-base">All maintenance requests</p>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="flex items-center justify-between">
                <p class="text-sm text-slate-600 sm:text-base">Pending</p>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600">
                    <i class="fa-solid fa-clock text-red-600" aria-hidden="true"></i>
                </div>
            </div>
            <p class="mt-2 text-2xl text-red-700 font-semibold">{{ $pendingRequests ?? 0 }}</p>
            <p class="text-sm text-red-500 sm:text-base">Awaiting action</p>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5 sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between">
                <p class="text-sm text-slate-600 sm:text-base">Completed</p>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-circle-check text-emerald-600" aria-hidden="true"></i>
                </div>
            </div>
            <p class="mt-2 text-2xl text-green-700 font-semibold">{{ $completedRequests ?? 0 }}</p>
            <p class="text-sm text-green-500 sm:text-base">Resolved issues</p>
        </div>
    </section>

    <section class="rounded-lg border border-slate-200 bg-white px-3 py-4 shadow-sm sm:px-5 sm:py-5">
        <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-lg font-semibold sm:text-xl">Maintenance Requests</h1>
                <p class="text-sm text-slate-500 sm:text-base">View and manage maintenance requests</p>
            </div>

        </div>

        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($maintenances ?? [] as $maintenance)
                <article class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-4 shadow-sm transition hover:border-blue-200 hover:bg-white hover:shadow-sm sm:px-5 sm:py-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">Request #{{ $maintenance->id }}</h2>
                            <p class="mt-1 text-sm text-slate-500">{{ ucfirst($maintenance->priority ?? 'Normal') }}</p>
                        </div>
                        <span class="rounded-full px-2.5 py-1 text-[10px] font-medium sm:text-xs @if($maintenance->status == 'pending') bg-amber-50 text-amber-700 @elseif($maintenance->status == 'in_progress') bg-blue-50 text-blue-700 @else bg-emerald-50 text-emerald-700 @endif">
                            {{ ucfirst(str_replace('_', ' ', $maintenance->status ?? 'pending')) }}
                        </span>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">{{ $maintenance->description ?? 'No description' }}</p>
                    <div class="mt-5 flex items-center justify-between border-t border-slate-200 pt-4">
                        <a href="{{ route('maintenance.show', $maintenance) }}" class="text-sm font-semibold text-blue-800 hover:underline">View details</a>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('maintenance.edit', $maintenance) }}" class="text-slate-400 hover:text-blue-700" aria-label="Edit request {{ $maintenance->id }}"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                            <form method="POST" action="{{ route('maintenance.destroy', $maintenance) }}" onsubmit="return confirm('Delete this request?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-600" aria-label="Delete request {{ $maintenance->id }}"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full py-10 text-center text-sm text-slate-500">No maintenance requests found. Add your first request to get started.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
