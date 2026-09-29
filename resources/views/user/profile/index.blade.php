@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
@php
    $user = auth()->user();
@endphp

<div class="mx-auto max-w-5xl space-y-6">

    {{-- Page Header --}}
    <section class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5">
        <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600">
                <i class="fa-solid fa-user" aria-hidden="true"></i>
            </span>
            <div>
                <h1 class="text-xl font-semibold">My Profile</h1>
                <p class="text-sm text-blue-200 sm:text-base">Manage your account settings and preferences</p>
            </div>
        </div>
    </section>

    @if (session('status'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-green-600" aria-hidden="true"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Left Column: Profile Card with Smaller Image --}}
        <div class="lg:col-span-1">
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col items-center text-center">
                    @if ($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                    @else
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 border-2 border-gray-200">
                            <i class="fa-solid fa-user text-blue-400 text-2xl" aria-hidden="true"></i>
                        </div>
                    @endif
                    <h2 class="mt-4 text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-xs text-gray-500 truncate max-w-[200px]">{{ $user->email }}</p>
                    <span class="mt-2.5 inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                        {{ ucfirst($user->role ?? 'user') }}
                    </span>
                </div>

                <div class="mt-6 border-t border-gray-100 pt-5 space-y-3">
                    <a href="{{ route('user.profile.edit') }}" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        <i class="fa-solid fa-pen-to-square text-gray-400"></i> Edit Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2 text-center text-sm font-medium text-red-600 hover:bg-red-50 transition">
                            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Right Column: Details & Settings --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Personal Information --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-4">Personal Information</h3>
                <dl class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-400">Full Name</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-400">Email Address</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-400">Phone Number</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->phone ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wider text-gray-400">Member Since</dt>
                        <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->created_at?->format('M d, Y') ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Quick Actions --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('user.usage.index') }}" class="group flex items-center justify-between rounded-lg border border-gray-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/40">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Usage History</p>
                                <p class="text-xs text-gray-500">View your past locker sessions</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400 transition group-hover:translate-x-0.5 group-hover:text-blue-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection