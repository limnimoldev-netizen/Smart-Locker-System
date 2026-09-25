@props([
    'currentRoute' => null,
])

@php
    $userRole = auth()->user()->role ?? 'admin';
    $isStaff = in_array($userRole, ['admin', 'staff'], true);
    $displayName = auth()->user()->name ?? ($isStaff ? 'Admin' : 'User');
    $initial = strtoupper(substr($displayName, 0, 1));
@endphp

<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full bg-[#234397] text-[#C7D2EE] shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
    <div class="flex flex-col h-full">
        <div class="px-5 pt-7">
            <div class="flex justify-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Smart Locker Logo" class="h-28 w-auto object-contain" onerror="this.style.display='none'">
            </div>
            <div class="mt-5 border-b border-white/20"></div>
        </div>
        <button id="sidebar-close" class="absolute right-3 top-3 rounded-lg p-2 text-blue-100 transition hover:bg-white/10 hover:text-white lg:hidden" aria-label="Close navigation">
            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>


        <nav class="flex-1 overflow-y-auto px-4 py-6" aria-label="Main navigation">
            @if ($isStaff)
            <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-blue-100/55">Main menu</p>
            <ul class="space-y-1.5">
                <li>
                    <a href="/dashboard" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-white transition-colors hover:bg-white/10 {{ request()->is('dashboard') ? 'bg-[#2f4da2] shadow-sm' : '' }}">
                        <i class="fa-solid fa-house w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Dashboard</span>
                        @if (request()->is('dashboard'))<i class="fa-solid fa-chevron-right text-[10px]" aria-hidden="true"></i>@endif
                    </a>
                </li>
                <li>
                    <a href="/locations" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('locations*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-location-dot w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Locations</span>
                    </a>
                </li>
                <li>
                    <a href="/lockers" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('lockers*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-box w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Lockers</span>
                    </a>
                </li>
                <li>
                    <a href="/users" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('users*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-users w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Users &amp; Usage</span>
                    </a>
                </li>
            </ul>

            <p class="mb-3 mt-7 px-3 text-[11px] font-medium uppercase tracking-wider text-blue-100/55">System</p>
            <ul class="space-y-1.5">
                <li>
                    <a href="/maintenance" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('maintenance*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-screwdriver-wrench w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Maintenance</span>
                    </a>
                </li>
            </ul>
            @else
            <p class="mb-3 px-3 text-[11px] font-medium uppercase tracking-wider text-blue-100/55">Your locker</p>
            <ul class="space-y-1.5">
                <li>
                    <a href="/dashboard" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('dashboard') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-house w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Home</span>
                    </a>
                </li>
                <li>
                    <a href="/user/locations" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('user/locations*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-location-dot w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Find a Locker</span>
                    </a>
                </li>
                <li>
                    <a href="/user/lockers" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('user/lockers*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-box w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">My Locker</span>
                    </a>
                </li>
                <li>
                    <a href="/user/usage" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('user/usage*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Usage History</span>
                    </a>
                </li>
            </ul>

            <p class="mb-3 mt-7 px-3 text-[11px] font-medium uppercase tracking-wider text-blue-100/55">Account</p>
            <ul class="space-y-1.5">
                <li>
                    <a href="/user/profile" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-blue-100/90 transition-colors hover:bg-white/10 hover:text-white {{ request()->is('user/profile*') ? 'bg-[#2f4da2] text-white shadow-sm' : '' }}">
                        <i class="fa-solid fa-user w-4 text-center text-[13px]" aria-hidden="true"></i>
                        <span class="flex-1">Profile</span>
                    </a>
                </li>
            </ul>
            @endif
        </nav>

        <div class="border-t border-white/20 px-5 py-5">
            <div class="flex items-center gap-3 rounded-lg px-1 py-1">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-xs font-bold text-[#234397]">{{ $initial }}</div>
                <div class="min-w-0 flex-1"><p class="truncate text-xs font-semibold text-white">{{ $displayName }}</p><p class="truncate text-[11px] text-blue-100/55">{{ $isStaff ? ucfirst($userRole) : 'Locker customer' }}</p></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-md p-2 text-blue-100/80 transition hover:bg-white/10 hover:text-white" title="Log out" aria-label="Log out">
                        <i class="fa-solid fa-arrow-right-from-bracket text-sm" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
