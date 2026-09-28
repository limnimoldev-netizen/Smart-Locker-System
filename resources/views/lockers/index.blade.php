@extends('layouts.app')

@section('title', 'Manage Lockers')

@section('content')

    <div class="mx-auto max-w-6xl space-y-6 bg-[#F8F9FA]">

        <section class=" bg-[#1E3A8A] px-6 py-5 text-white  rounded-lg  shadow-md sm:px-8">
            <div class="flex items-center gap-3 sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="bg-blue-600 flex items-center justify-center h-10 w-10 rounded-lg ">
                        <i class="fa-solid fa-box" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h1 class="text-xl font-semibold">Lockers</h1>
                        <p class="text-base text-blue-200">Manage lockers across all locations</p>
                    </div>
                </div>
                <a href="{{ route('lockers.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] ">
                    <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                    Add locker
                </a>
            </div>
        </section>

        <section class=" grid gap-8 sm:grid-cols-3">

            <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600 ">Total lockers</p>
                    <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                </div>
                <p class=" mt-2 text-2xl font-semibold">{{ $totalLockers ?? 0 }}</p>
                <p class="text-base text-slate-500">At all locations</p>
            </div>
            <div>
                <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                    <div class="flex items-center justify-between">
                        <p class="text-base text-slate-600 ">Available lockers</p>
                        <i class="fa-solid fa-circle-check text-emerald-600" aria-hidden="true"></i>
                    </div>
                    <p class=" mt-2 text-2xl font-semibold">{{ $availableLockers ?? 0 }}</p>
                    <p class="text-base text-slate-500">Ready for customers</p>
                </div>
            </div>
            <div>
                <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                    <div class="flex items-center justify-between">
                        <p class="text-base text-slate-600 ">In maintenance</p>
                        <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                    </div>
                    <p class=" mt-2 text-2xl font-semibold">{{ $maintenanceLockers ?? 0 }}</p>
                    <p class="text-base text-slate-500">At all locations</p>

                </div>
            </div>
        </section>

        <section class="bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm  ">

            <div class="flex items-center justify-between gap-3 border-slate-200 pb-5">
                <div>
                    <h1 class="text-xl font-semibold">Locker Lists</h1>
                    <p class="text-base text-slate-500">View and manage lockers at this location</p>
                </div>

                <label class="relative block w-40 sm:w-44">
                    <span class="sr-only">Search lockers</span>
                    <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"></i>
                    <input type="search" placeholder="Search lockers" class="w-full rounded-lg border border-slate-200 py-2 pl-8 pr-3 text-base text-slate-700 outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </label>

            </div>

            <div class=" -mx-5 overflow-x-auto">
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
