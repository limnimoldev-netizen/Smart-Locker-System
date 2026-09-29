@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col" id="locationLockerPage" data-lockers="{{ json_encode($lockers) }}">

    {{-- Header --}}
    <header class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5">
        <a href="{{ url()->previous() }}" class="text-white  rounded-lg hover:bg-white/10 transition-colors flex-shrink-0">
          
        </a>
        <h1 class="text-lg sm:text-2xl font-bold">Location Details</h1>
    </header>

    <div class="px-5 sm:px-10 lg:px-16 py-6 sm:py-10 flex-1">

        <h2 class="text-xl sm:text-3xl font-bold text-gray-900">{{ $location->name }}</h2>
        <p class="text-sm sm:text-base text-gray-500 mt-1 flex items-center gap-1">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ $location->address }}
        </p>
        <p class="text-base sm:text-lg font-bold text-gray-900 mt-6 sm:mt-8 mb-3">Select a Locker</p>

        {{-- Locker grid --}}
        <div id="lockerGrid" class="pb-10 pt-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 items-start"></div>

        {{-- Legend --}}
        <div class="flex flex-wrap items-center justify-center gap-4 py-3 bg-white border border-gray-100 rounded-full text-sm shadow-sm max-w-md mx-auto">
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-green-500"></span>Available</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-red-500"></span>In Use</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-gray-400"></span>Maint.</span>
        </div>

        <div class="sm:flex sm:items-end sm:gap-5 sm:max-w-2xl mt-5">
            {{-- Selected locker panel --}}
            <div id="selectedPanel" class="hidden bg-white border border-gray-200 rounded-2xl p-4 shadow-sm flex-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p id="selectedName" class="font-bold text-gray-900"></p>
                        <p id="selectedMeta" class="text-xs text-gray-500 capitalize"></p>
                    </div>
                    <span id="selectedStatus" class="flex items-center gap-1.5 text-sm font-semibold"></span>
                </div>
            </div>

            <button id="selectBtn" disabled class="w-full sm:w-auto sm:px-10 bg-blue-900 text-white font-semibold rounded-2xl py-4 mt-5 sm:mt-0 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-blue-950 transition-colors flex-shrink-0">
                Select Locker
            </button>
        </div>
    </div>
</div>

<script>
    const lockers = JSON.parse(document.getElementById('locationLockerPage').dataset.lockers);
    let selected = null;

    function statusMeta(status) {
        if (status === 'available') return { cls: 'text-green-600', border: 'border-green-300 bg-green-50', dot: 'bg-green-500', label: 'Available' };
        if (status === 'in_use') return { cls: 'text-red-600', border: 'border-red-300 bg-red-50', dot: 'bg-red-500', label: 'In Use' };
        return { cls: 'text-gray-500', border: 'border-gray-200 bg-gray-50', dot: 'bg-gray-400', label: 'Maint.' };
    }

    function renderGrid() {
        const grid = document.getElementById('lockerGrid');
        grid.innerHTML = lockers.map(locker => {
            const s = statusMeta(locker.status);
            const isSelected = selected && selected.id === locker.id;
            return `
                <button
                    data-id="${locker.id}"
                    class="locker-btn border rounded-xl py-4 text-center transition-all bg-white shadow-sm hover:shadow-md ${s.border} ${isSelected ? 'ring-2 ring-blue-900' : ''}"
                >
                    <p class="font-bold text-sm text-gray-900">${locker.locker_number}</p>
                    <p class="text-xs ${s.cls}">${s.label}</p>
                </button>`;
        }).join('');

        document.querySelectorAll('.locker-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = parseInt(btn.dataset.id);
                selected = lockers.find(l => l.id === id);
                renderGrid();
                renderSelected();
            });
        });
    }

    function renderSelected() {
        const panel = document.getElementById('selectedPanel');
        const btn = document.getElementById('selectBtn');

        if (!selected) {
            panel.classList.add('hidden');
            btn.disabled = true;
            return;
        }

        const s = statusMeta(selected.status);
        document.getElementById('selectedName').textContent = `Locker-${selected.locker_number}`;
        document.getElementById('selectedMeta').textContent = `${selected.type || 'Standard'} locker`;
        document.getElementById('selectedStatus').innerHTML = `<span class="w-2 h-2 rounded-full ${s.dot}"></span>${s.label}`;
        document.getElementById('selectedStatus').className = `flex items-center gap-1.5 text-sm font-semibold ${s.cls}`;
        panel.classList.remove('hidden');

        btn.disabled = selected.status !== 'available';
    }

    document.getElementById('selectBtn').addEventListener('click', () => {
        if (!selected || selected.status !== 'available') return;
        window.location.href = `/user/lockers/${selected.id}/confirm`;
    });

    renderGrid();
</script>
@endsection