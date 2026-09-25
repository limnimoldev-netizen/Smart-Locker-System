@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col">

    {{-- Header --}}
    <header class="bg-gradient-to-br from-blue-800 via-blue-900 to-indigo-950 text-white px-5 sm:px-10 lg:px-16 pt-8 sm:pt-12 pb-8 sm:pb-10 flex-shrink-0 shadow-lg">
        <h1 class="text-2xl sm:text-4xl font-extrabold mb-4 tracking-tight">Find a Location</h1>
        <div class="bg-white rounded-2xl flex items-center gap-3 px-5 py-4 max-w-md shadow-xl shadow-blue-950/30 ring-1 ring-white/10 focus-within:ring-2 focus-within:ring-blue-400 transition-all">
            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <input
                type="text"
                id="searchInput"
                placeholder="Mall, library, gym..."
                class="w-full text-sm text-gray-900 placeholder-gray-400 outline-none border-none bg-transparent"
            />
        </div>
    </header>

    {{-- Filter pills --}}
    <div id="filters" class="flex gap-2.5 px-5 sm:px-10 lg:px-16 pt-6 pb-4 overflow-x-auto scrollbar-hide flex-shrink-0">
        <button data-filter="all" class="pill px-6 py-3 rounded-full text-[15px] font-semibold whitespace-nowrap bg-blue-900 text-white shadow-md shadow-blue-900/20">All</button>
        <button data-filter="mall" class="pill px-6 py-3 rounded-full text-[15px] font-semibold whitespace-nowrap bg-white text-gray-600 border border-gray-200 hover:border-gray-300 transition-colors">Mall</button>
        <button data-filter="library" class="pill px-6 py-3 rounded-full text-[15px] font-semibold whitespace-nowrap bg-white text-gray-600 border border-gray-200 hover:border-gray-300 transition-colors">Library</button>
        <button data-filter="sports" class="pill px-6 py-3 rounded-full text-[15px] font-semibold whitespace-nowrap bg-white text-gray-600 border border-gray-200 hover:border-gray-300 transition-colors">Sports</button>
        <button data-filter="station" class="pill px-6 py-3 rounded-full text-[15px] font-semibold whitespace-nowrap bg-white text-gray-600 border border-gray-200 hover:border-gray-300 transition-colors">Station</button>
    </div>

    {{-- Location list --}}
    <div id="list" class="px-5 sm:px-10 lg:px-16 pb-10 pt-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 items-start"></div>
    <p id="emptyMsg" class="text-center text-gray-400 text-sm py-16 hidden">No locations match your search.</p>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
    const locations = @json($locations);

    const iconMap = {
        mall: '<svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v18"/><path d="M6 12H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h2"/><path d="M18 9h2a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>',
        library: '<svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/></svg>',
        sports: '<svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21h8"/><path d="M12 17v4"/><path d="M7 4h10v6a5 5 0 0 1-10 0z"/><path d="M17 5h2.5a1 1 0 0 1 1 1.5 4 4 0 0 1-4.5 3"/><path d="M7 5H4.5a1 1 0 0 0-1 1.5A4 4 0 0 0 8 9.5"/></svg>',
        station: '<svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="13" rx="2"/><path d="M4 11h16"/><path d="M12 3v8"/><path d="m8 19-2 3"/><path d="m18 22-2-3"/><path d="M8 15h.01"/><path d="M16 15h.01"/></svg>',
    };

    function status(free) {
        if (free === 0) return { cls: 'bg-red-50 text-red-600 ring-1 ring-red-200', dot: 'bg-red-500', label: 'Full' };
        if (free <= 3) return { cls: 'bg-amber-50 text-amber-700 ring-1 ring-amber-200', dot: 'bg-amber-500', label: `${free} free` };
        return { cls: 'bg-green-50 text-green-700 ring-1 ring-green-200', dot: 'bg-green-500', label: `${free} free` };
    }

    let activeFilter = 'all';
    let query = '';

    function render() {
        const list = document.getElementById('list');
        const emptyMsg = document.getElementById('emptyMsg');

        const filtered = locations.filter(loc => {
            const matchesFilter = activeFilter === 'all' || loc.type === activeFilter;
            const matchesQuery = !query || loc.name.toLowerCase().includes(query) || loc.type.toLowerCase().includes(query);
            return matchesFilter && matchesQuery;
        });

        list.innerHTML = filtered.map(loc => {
            const s = status(loc.free_count);
            const icon = iconMap[loc.type] || iconMap.mall;
            return `
                <a href="/locations/${loc.slug ?? loc.id}" class="flex items-center gap-4 bg-white border border-gray-100 rounded-2xl px-5 py-5 shadow-sm hover:shadow-lg hover:-translate-y-0.5 hover:border-blue-100 transition-all duration-150">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 text-blue-900 flex items-center justify-center flex-shrink-0 p-3">${icon}</div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-base text-gray-900 truncate">${loc.name}</p>
                        <p class="text-xs text-gray-400 truncate mt-1">${loc.address}</p>
                        <div class="flex items-center gap-1.5 mt-2 px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap w-fit ${s.cls}">
                            <span class="w-1.5 h-1.5 rounded-full ${s.dot}"></span>${s.label}
                        </div>
                    </div>
                </a>`;
        }).join('');

        emptyMsg.classList.toggle('hidden', filtered.length !== 0);
    }

    document.getElementById('filters').addEventListener('click', (e) => {
        const btn = e.target.closest('.pill');
        if (!btn) return;
        document.querySelectorAll('.pill').forEach(p => {
            p.classList.remove('bg-blue-900', 'text-white', 'shadow-md', 'shadow-blue-900/20');
            p.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        });
        btn.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
        btn.classList.add('bg-blue-900', 'text-white', 'shadow-md', 'shadow-blue-900/20');
        activeFilter = btn.dataset.filter;
        render();
    });

    document.getElementById('searchInput').addEventListener('input', (e) => {
        query = e.target.value.trim().toLowerCase();
        render();
    });

    render();
</script>
@endsection