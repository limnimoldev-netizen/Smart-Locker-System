@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')

<div class="flex items-center justify-between w-full">
    <div class="">
        <h1 class="text-xl md:text-2xl font-black uppercase">Operations Dashboard</h1>
        <p class="text-gray-400 text-xs md:text-xs">Real-time overview of your locker network performance.</p>
    </div>
</div>

<!-- 4MiniDashboard -->
<div class="grid grid-cols-2 md:grid-cols-4 items-center mt-5 gap-4 md:gap-6">
    @foreach ($stats as $stat)
    <div class="bg-gray-200 p-4 rounded-lg flex flex-col gap-1 border border-gray-100">
        <div class="flex items-center justify-between">
            <p class="text-xs md:text-xs text-gray-500">{{ $stat['label'] }}</p>
            <div class="w-5 h-5 {{ $stat['class'] }} rounded-lg p-4 md:flex items-center justify-center hidden">
                <i class="fa-solid {{ $stat['icon'] }} text-md"></i>
            </div>
        </div>
        <h1 class="font-black {{ $stat['class_value'] }} text-2xl md:text-4xl font-display">{{ $stat['value'] }}</h1>
        @if (!empty($stat['trend']))
        <span class="text-xs {{ $stat['class_trend'] }} flex items-center gap-1">
            <i class="fa-solid {{ $stat['trend_icon'] ?? 'fa-circle-info' }}"></i>{{ $stat['trend'] }}
        </span>
        @endif
    </div>
    @endforeach
</div>

<!-- Function -->
<div class="flex items-center mt-6" x-data="{ 
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
                   placeholder="Search locker code or location...">
        </div>

        <!-- Status Filter (Real-Time) -->
        <div class="flex items-center gap-2">
            <select name="status" x-model="status" @change="submitForm()"
                    class="block rounded-md border border-gray-300 shadow-sm text-xs py-2 pl-3 pr-8 focus:border-brand focus:ring-2 focus:ring-brand/20 focus:outline-none bg-white text-gray-700">
                <option value="">All Statuses</option>
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="cleaning">Cleaning</option>
                <option value="maintenance">Under Maintenance</option>
                <option value="outofservice">Out of Service</option>
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

<div class="overflow-x-auto shadow-sm border border-gray-200 rounded-lg mt-5">
    <table class="min-w-full divide-y divide-gray-200">
        
        <!-- TABLE HEADER -->
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Locker Code</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Opening Hours</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>

            </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($dataLockers as $locker)
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">{{ $locker->locker_code }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">{{ $locker->location?->location_name ?? '_' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">{{ $locker->location?->opening_hours ?? '_' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold text-capitalize {{ $locker->status->color() }}">
                        {{ $locker->status->label() ?? $locker->status }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex items-center justify-end space-x-2">
                        <a href="{{ route('lockers.edit', $locker->locker_id) }}" 
                           class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition-colors text-xs font-semibold">
                            Edit
                        </a>
                        
                        <form action="{{ route('lockers.destroy', $locker->locker_id) }}" method="POST" onsubmit="return confirm('Delete this locker?');" class="inline">
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
                <td colspan="5" class="px-6 py-4 text-center text-xs text-gray-400">
                    No lockers yet
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $dataLockers->links() }}
    </div>
</div>
@endsection

