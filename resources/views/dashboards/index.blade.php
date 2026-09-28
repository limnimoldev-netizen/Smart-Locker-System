@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

<div class="mx-auto max-w-6xl space-y-6 bg-[#F8F9FA] sm:space-y-8">
    <section class="rounded-lg bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:px-8 sm:py-5">
        <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600">
                <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
            </span>
            <div>
                <h1 class="text-xl font-semibold">Operations Dashboard</h1>
                <p class="text-sm text-blue-200 sm:text-base">Real-time overview of your locker network performance</p>
            </div>
        </div>
    </section>

<!-- 4MiniDashboard -->
<section class="grid grid-cols-2 gap-4 md:grid-cols-4 md:gap-6">
    @foreach ($stats as $stat)
    <div class="flex flex-col gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
        <div class="flex items-center justify-between">
            <p class="text-sm text-slate-600">{{ $stat['label'] }}</p>
            <div class="hidden h-9 w-9 items-center justify-center rounded-lg {{ $stat['class'] }} md:flex">
                <i class="fa-solid {{ $stat['icon'] }} text-sm" aria-hidden="true"></i>
            </div>
        </div>
        <p class="font-display text-2xl font-black {{ $stat['class_value'] }} sm:text-3xl">{{ $stat['value'] }}</p>
        @if (!empty($stat['trend']))
        <span class="flex items-center gap-1 text-xs {{ $stat['class_trend'] }}">
            <i class="fa-solid {{ $stat['trend_icon'] ?? 'fa-circle-info' }}"></i>{{ $stat['trend'] }}
        </span>
        @endif
    </div>
    @endforeach
</section>

<section class="rounded-lg border border-slate-200 bg-white px-3 py-4 shadow-sm sm:px-5 sm:py-5">
    <div class="mb-5">
        <h2 class="text-lg font-semibold sm:text-xl">Locker Overview</h2>
        <p class="text-sm text-slate-500">Search, filter, and manage lockers across all locations.</p>
    </div>

<div class="mb-5 flex items-center" x-data="{ 
    search: '{{ request('search') }}',
    status: '{{ request('status') }}',
    debounceTimer: null,
    submitForm() {
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(() => {
            $refs.filterForm.submit();
        }, 300); // Wait 300ms after typing stops
    }
}">
    <form x-ref="filterForm" action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center justify-between gap-3 w-full">
        
        <!-- Search Input (Real-Time) -->
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
            </div>
            <input type="text" name="search" x-model="search" @input="submitForm()"
                   class="block w-full pl-9 pr-3 py-2 rounded-md border border-gray-300 shadow-sm text-xs focus:border-brand focus:ring-2 focus:ring-brand/20 focus:outline-none placeholder:text-gray-400" 
                   placeholder="Search locker number or location...">
        </div>

        <!-- Status Filter (Real-Time) -->
        <div class="flex items-center gap-2">
            <select name="status" x-model="status" @change="submitForm()"
                    class="block rounded-md border border-gray-300 shadow-sm text-xs py-2 pl-3 pr-8 focus:border-brand focus:ring-2 focus:ring-brand/20 focus:outline-none bg-white text-gray-700">
                <option value="">All Statuses</option>
                <option value="available">Available</option>
                <option value="in_use">In Use</option>
                <option value="occupied">Occupied</option>
                <option value="reserved">Reserved</option>
                <option value="cleaning">Cleaning</option>
                <option value="maintenance">Under Maintenance</option>
                <option value="out_of_service">Out of Service</option>
                <option value="disabled">Disabled</option>
            </select>
    
            <!-- Clear Button -->
            @if(request()->has('search') || request()->has('status'))
                <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                    Clear
                </a>
            @endif
        </div>

    </form>
</div>

<div class="-mx-3 overflow-x-auto border-y border-slate-200 sm:-mx-5">
    <table class="min-w-full divide-y divide-slate-200">
        
        <!-- TABLE HEADER -->
        <thead class="bg-slate-50">
            <tr>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Locker Number</th>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Location</th>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Address</th>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                <th scope="col" class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">Action</th>

            </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($dataLockers as $locker)
            <tr class="text-slate-700 transition-colors hover:bg-slate-50">
                <td class="whitespace-nowrap px-5 py-4 text-sm font-medium text-slate-900">{{ $locker->locker_number }}</td>
                <td class="whitespace-nowrap px-5 py-4 text-sm">{{ $locker->dashboard_location_name ?? '_' }}</td>
                <td class="whitespace-nowrap px-5 py-4 text-sm">{{ $locker->dashboard_location_address ?? '_' }}</td>
                <td class="whitespace-nowrap px-5 py-4">
                    @php
                        $status = (string) $locker->status;
                        $statusLabel = \App\Enums\LockerStatus::tryFrom($status)?->label() ?? \Illuminate\Support\Str::headline($status);
                        $statusClass = match ($status) {
                            'available' => 'text-green-700 bg-green-100',
                            'occupied', 'reserved' => 'text-blue-700 bg-blue-100',
                            'maintenance', 'cleaning' => 'text-orange-700 bg-orange-100',
                            'out_of_service' => 'text-red-700 bg-red-100',
                            default => 'text-gray-700 bg-gray-100',
                        };
                    @endphp
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </td>
                <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-medium">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('lockers.edit', $locker->id) }}" 
                           class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition-colors text-xs font-semibold">
                            Edit
                        </a>
                        
                        <form action="{{ route('lockers.destroy', $locker->id) }}" method="POST" onsubmit="return confirm('Delete this locker?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition-colors text-xs font-semibold">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-5 py-8 text-center text-sm text-slate-500">
                    No lockers yet
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>
    <div class="px-5 py-4">
        {{ $dataLockers->links() }}
    </div>
</div>
</section>
</div>
@endsection

