@extends('layouts.app')

@section('title', 'Manage Lockers')

@section('content')

    <div class="mx-auto max-w-6xl space-y-4 bg-[#F8F9FA] sm:space-y-6">

        <section class="rounded-lg bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:px-8 sm:py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                        <i class="fa-solid fa-box" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h1 class="text-xl font-semibold">Lockers</h1>
                        <p class="text-sm text-blue-200 sm:text-base">Manage lockers across all locations</p>
                    </div>
                </div>
                <a href="{{ route('lockers.create') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] sm:w-auto">
                    <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                    Add locker
                </a>
            </div>
        </section>

        <section class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 sm:text-base">Total lockers</p>
                    <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">{{ $totalLockers ?? 0 }}</p>
                <p class="text-sm text-slate-500 sm:text-base">At all locations</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 sm:text-base">Available lockers</p>
                    <i class="fa-solid fa-circle-check text-emerald-600" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">{{ $availableLockers ?? 0 }}</p>
                <p class="text-sm text-slate-500 sm:text-base">Ready for customers</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5 sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 sm:text-base">In maintenance</p>
                    <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">{{ $maintenanceLockers ?? 0 }}</p>
                <p class="text-sm text-slate-500 sm:text-base">At all locations</p>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white px-3 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="flex flex-col gap-3 border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-lg font-semibold sm:text-xl">Locker Lists</h1>
                    <p class="text-sm text-slate-500 sm:text-base">View and manage lockers at this location</p>
                </div>

                <label class="relative block w-full max-w-xs sm:w-44">
                    <span class="sr-only">Search lockers</span>
                    <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"></i>
                    <input type="search" placeholder="Search lockers" class="w-full rounded-lg border border-slate-200 py-2 pl-8 pr-3 text-sm text-slate-700 outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 sm:text-base">
                </label>
            </div>

            <div class="sm:hidden">
                @forelse($lockers ?? [] as $locker)
                    <div class="mb-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-wide text-slate-400">Locker</p>
                                <p class="mt-1 text-base font-semibold text-slate-900">#{{ $locker->id }}</p>
                            </div>
                            <span class="rounded-full px-2.5 py-1 text-[10px] font-semibold @if($locker->status == 'available') bg-emerald-50 text-emerald-700 @elseif($locker->status == 'in_use') bg-red-50 text-red-600 @else bg-orange-50 text-orange-600 @endif">
                                {{ ucfirst(str_replace('_', ' ', $locker->status)) }}
                            </span>
                        </div>

                        <div class="mt-3 space-y-2 text-sm text-slate-600">
                            <p><span class="font-medium text-slate-700">Type:</span> {{ ucfirst($locker->type) }}</p>
                        </div>

                        <div class="mt-4 flex items-center justify-end gap-3 border-t border-slate-200 pt-3">
                            <a href="{{ route('lockers.show', $locker) }}" class="text-slate-500 hover:text-blue-700" aria-label="View locker {{ $locker->id }}">
                                <i class="fa-solid fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('lockers.edit', $locker) }}" class="text-slate-500 hover:text-blue-700" aria-label="Edit locker {{ $locker->id }}">
                                <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5 text-center text-sm text-slate-500">
                        No lockers found. <a href="{{ route('lockers.create') }}" class="text-blue-600 hover:underline">Add your first locker</a>
                    </div>
                @endforelse
            </div>

            <div class="hidden sm:block -mx-3 overflow-x-auto sm:-mx-5">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="border-y border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th scope="col" class="px-5 py-3 font-semibold">ID</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Type</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Status</th>
                            <th scope="col" class="px-5 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($lockers ?? [] as $locker)
                        <tr class="text-slate-700 transition-colors hover:bg-slate-50">
                            <td class="px-5 py-4 font-medium text-slate-900">#{{ $locker->id }}</td>
                            <td class="px-5 py-4">{{ ucfirst($locker->type) }}</td>
                            <td class="px-5 py-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-semibold @if($locker->status == 'available') bg-emerald-50 text-emerald-700 @elseif($locker->status == 'in_use') bg-red-50 text-red-600 @else bg-orange-50 text-orange-600 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $locker->status)) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('lockers.show', $locker) }}" title="View locker" aria-label="View locker {{ $locker->id }}" class="mr-3 text-slate-400 transition hover:text-blue-700">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('lockers.edit', $locker) }}" title="Edit locker" aria-label="Edit locker {{ $locker->id }}" class="text-slate-400 transition hover:text-blue-700">
                                    <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-slate-500">
                                <p class="text-sm">No lockers found. <a href="{{ route('lockers.create') }}" class="text-blue-600 hover:underline">Add your first locker</a></p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

@endsection
