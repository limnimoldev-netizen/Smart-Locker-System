@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
@php
    $initial = strtoupper(substr($user->name, 0, 1));

    $menu = [
        ['title' => 'Edit Profile',      'desc' => 'Update your name, email and phone',  'href' => route('user.profile.edit'),  'icon' => 'fa-pen',                'tile' => 'bg-[#1E3A8A]/10 text-[#1E3A8A]'],
        ['title' => 'Notification',      'desc' => 'Alerts about your bookings',          'href' => '#',                         'icon' => 'fa-bell',               'tile' => 'bg-[#FFEDD5] text-[#EA580C]'],
        ['title' => 'Usage History',     'desc' => 'Your past locker sessions',           'href' => route('user.usage.index'),   'icon' => 'fa-clock-rotate-left',  'tile' => 'bg-[#DCFCE7] text-[#16A34A]'],
        ['title' => 'Privacy & Security','desc' => 'Password and account safety',         'href' => '#',                         'icon' => 'fa-lock',               'tile' => 'bg-[#1E3A8A]/10 text-[#1E3A8A]'],
    ];
@endphp

<div class="mx-auto max-w-6xl space-y-6">

    @if (session('status'))
        <div class="rounded-lg border border-[#BBF7D0] bg-[#DCFCE7] px-4 py-3 text-sm font-medium text-[#16A34A]">
            <i class="fa-solid fa-circle-check mr-2" aria-hidden="true"></i>{{ session('status') }}
        </div>
    @endif

    {{-- 1. Hero: banner + big profile circle --}}
    <section class="overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="h-32 bg-gradient-to-r from-[#1E3A8A] to-[#2f4da2]"></div>

        <div class="flex flex-col gap-5 px-6 pb-6 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div class="-mt-14 flex flex-col items-center gap-4 sm:flex-row sm:items-end">
                <div class="flex h-28 w-28 shrink-0 items-center justify-center rounded-full bg-[#1E3A8A] text-4xl font-bold text-white ring-4 ring-white">
                    {{ $initial }}
                </div>
                <div class="pb-1 text-center sm:text-left">
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:justify-start">
                        <h1 class="text-2xl font-semibold text-[#111827]">{{ $user->name }}</h1>
                        <span class="rounded-full border border-[#BBF7D0] bg-[#DCFCE7] px-3 py-1 text-xs font-semibold text-[#16A34A]">
                            {{ ucfirst($user->role ?? 'user') }}
                        </span>
                    </div>
                    <p class="mt-1 break-all text-base text-[#6B7280]">{{ $user->email }}</p>
                </div>
            </div>

            <a href="{{ route('user.profile.edit') }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <i class="fa-solid fa-pen text-xs" aria-hidden="true"></i>
                Edit profile
            </a>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- 2. Account settings (2/3 width) --}}
        <section class="rounded-xl bg-white p-6 shadow-sm lg:col-span-2">
            <h2 class="text-xl font-semibold text-[#111827]">Account Settings</h2>
            <p class="mt-1 text-base text-[#6B7280]">Manage your profile, activity and security</p>

            <div class="mt-4 divide-y divide-slate-100">
                @foreach ($menu as $item)
                    <a href="{{ $item['href'] }}"
                       class="group flex items-center gap-4 rounded-lg px-3 py-4 transition hover:bg-slate-50">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $item['tile'] }}">
                            <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                        </span>
                        <span class="flex-1">
                            <span class="block text-base font-semibold text-[#111827]">{{ $item['title'] }}</span>
                            <span class="block text-sm text-[#6B7280]">{{ $item['desc'] }}</span>
                        </span>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300 transition group-hover:translate-x-0.5 group-hover:text-[#1E3A8A]" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- 3. Account details + logout (1/3 width) --}}
        <section class="self-start rounded-xl bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-[#111827]">Account Details</h2>

            <dl class="mt-4 space-y-5">
                <div>
                    <dt class="text-xs uppercase tracking-wide text-[#6B7280]">Full name</dt>
                    <dd class="mt-1 text-base font-medium text-[#111827]">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-[#6B7280]">Email</dt>
                    <dd class="mt-1 break-all text-base font-medium text-[#111827]">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-[#6B7280]">Mobile number</dt>
                    <dd class="mt-1 text-base font-medium {{ $user->phone ? 'text-[#111827]' : 'text-slate-400' }}">
                        {{ $user->phone ?: 'Not added yet' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-[#6B7280]">Member since</dt>
                    <dd class="mt-1 text-base font-medium text-[#111827]">{{ $user->created_at?->format('d M Y') ?? '-' }}</dd>
                </div>
            </dl>

            
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#FEE2E2] px-4 py-3 text-sm font-semibold text-[#DC2626] transition hover:bg-[#FECACA]">
                    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                    Log Out
                </button>
            </form>
        </section>
    </div>
</div>
@endsection