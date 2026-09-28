@extends('layouts.app')

@section('title', 'Manage Locations')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6 bg-[#F8F9FA]">

        <section class="rounded-lg bg-[#1E3A8A] px-4 py-5 text-white shadow-md sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">   
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h1 class="text-xl font-semibold">Locations</h1>
                        <p class="text-base text-blue-200">Manage locker locations</p>
                    </div>
                </div>
                <a href="/locations/create" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] sm:w-auto">
                    <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                    Add location
                </a>
            </div>   
        </section>

        <section class=" grid gap-8 sm:grid-cols-3">
            
            <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600 ">Total locations</p>
                    <i class="fa-solid fa-location-dot text-blue-700" aria-hidden="true"></i>
                </div>
                <p class=" mt-2 text-2xl font-semibold">{{ $totalLocations }}</p>
                <p class="text-base text-slate-500">Across all branches</p>
            </div>
            <div>
                <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                    <div class="flex items-center justify-between">
                        <p class="text-base text-slate-600 ">Active locations</p>
                        <i class="fa-solid fa-circle-check text-emerald-600" aria-hidden="true"></i>
                    </div>
                    <p class=" mt-2 text-2xl font-semibold">{{ $activeLocations }}</p>
                    <p class="text-base text-slate-500">Ready for customers</p>
                </div>
            </div>
            <div>
                <div class=" bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm ">
                    <div class="flex items-center justify-between">
                        <p class="text-base text-slate-600 ">Total lockers</p>
                        <i class="fa-solid fa-box text-blue-700" aria-hidden="true"></i>
                    </div>
                    <p class=" mt-2 text-2xl font-semibold">{{ $totalLockers }}</p>
                    <p class="text-base text-slate-500">At all locations</p>

                </div>
            </div>   
        </section>

        <section class="bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm  ">
            <div class="flex items-center justify-between gap-3 border-b border-slate-200 pb-5">
                <div>
                    <h1 class="text-xl font-semibold">Location Lists</h1>
                    <p class="text-base text-slate-500">Manage branches and their lockers capacity</p>
                </div>
                
                <label class="relative block w-40 sm:w-44">
                    <span class="sr-only">Search locations</span>
                    <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"></i>
                    <input type="search" placeholder="Search locations" class="w-full rounded-lg border border-slate-200 py-2 pl-8 pr-3 text-base text-slate-700 outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </label>
                
            </div>

            <div class="mt-4 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($locations as $location)
                    <article class="rounded-lg border border-slate-200 bg-slate-50 px-5 py-5 shadow-sm transition hover:border-blue-200 hover:bg-white hover:shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-base font-semibold text-slate-900">{{ $location->name }}</h2>
                                <p class="mt-1 text-sm text-slate-500">Location #{{ $location->id }}</p>
                            </div>
                            <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $location->status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">{{ ucfirst($location->status) }}</span>
                        </div>
                        <p class="mt-4 text-sm text-slate-500"><i class="fa-solid fa-location-dot mr-2 text-blue-700" aria-hidden="true"></i>{{ $location->address }}</p>
                        <div class="mt-5 flex items-center justify-between border-t border-slate-200 pt-4">
                            <a href="{{ route('locations.show', $location) }}" class="text-sm font-semibold text-blue-800 hover:underline">View location</a>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('locations.edit', $location) }}" class="text-slate-400 hover:text-blue-700" aria-label="Edit {{ $location->name }}"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                                <form method="POST" action="{{ route('locations.destroy', $location) }}" onsubmit="return confirm('Delete this location?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-600" aria-label="Delete {{ $location->name }}"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full py-10 text-center text-sm text-slate-500">No locations found. Add your first location to get started.</p>
                @endforelse
            </div>



        </section>


    </div>
@endsection
