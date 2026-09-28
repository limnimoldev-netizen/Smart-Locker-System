@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    {{-- Header card --}}
    <div class="bg-blue-900 rounded-3xl px-10 py-10 flex items-center gap-8">
        <div class="w-28 h-28 flex-shrink-0 rounded-full border-4 border-white flex items-center justify-center">
            <svg class="w-14 h-14 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>
        <div>
            <h1 class="text-white text-2xl font-bold">{{ $user->name }}</h1>
            <p class="text-blue-200 text-sm mt-1">{{ $user->email }}</p>
        </div>
    </div>

    {{-- Menu grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">

        <a href="{{ route('profile.edit') }}"
           class="flex flex-col items-start gap-3 border border-gray-300 rounded-2xl px-6 py-6 hover:border-blue-900 hover:shadow-md transition">
            <svg class="w-6 h-6 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
            </svg>
            <span class="font-semibold text-gray-800">Edit Profile</span>
        </a>

        <a href="#"
           class="flex flex-col items-start gap-3 border border-gray-300 rounded-2xl px-6 py-6 hover:border-blue-900 hover:shadow-md transition">
            <svg class="w-6 h-6 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="font-semibold text-gray-800">Notification</span>
        </a>

        <a href="#"
           class="flex flex-col items-start gap-3 border border-gray-300 rounded-2xl px-6 py-6 hover:border-blue-900 hover:shadow-md transition">
            <svg class="w-6 h-6 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
            </svg>
            <span class="font-semibold text-gray-800">Usage History</span>
        </a>

        <a href="#"
           class="flex flex-col items-start gap-3 border border-gray-300 rounded-2xl px-6 py-6 hover:border-blue-900 hover:shadow-md transition">
            <svg class="w-6 h-6 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <span class="font-semibold text-gray-800">Privacy & Security</span>
        </a>
    </div>

    {{-- Logout --}}
    <div class="mt-8">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-100 text-red-500 font-semibold px-10 py-3 rounded-full hover:bg-red-200 transition">
                Log Out
            </button>
        </form>
    </div>
</div>
@endsection