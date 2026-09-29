@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
@php
    $user = auth()->user();
@endphp

<div class="mx-auto max-w-3xl space-y-6">

    {{-- Page Header --}}
    <section class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:rounded-lg sm:px-8 sm:py-5">
        <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600">
                <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
            </span>
            <div>
                <h1 class="text-xl font-semibold">Edit Profile</h1>
                <p class="text-sm text-blue-200 sm:text-base">Update your account information</p>
            </div>
        </div>
    </section>

    {{-- Form --}}
    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        @if (session('status'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-green-600" aria-hidden="true"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <div class="space-y-6">
            {{-- Profile Picture --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                <div class="flex items-center gap-5">
                    <div class="relative shrink-0">
                        <img id="profile-preview" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : '' }}" alt="Profile" style="width: 80px; height: 80px;" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200 shadow-sm {{ $user->profile_picture ? '' : 'hidden' }}">
                        <div id="profile-placeholder" class="{{ $user->profile_picture ? 'hidden' : '' }} flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 border-2 border-gray-200" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-user text-blue-400 text-2xl" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div>
                        {{-- Hidden real file input --}}
                        <input type="file" name="profile_picture" accept="image/jpeg,image/png,image/jpg,image/gif" id="profile-input" class="hidden">
                        
                        {{-- Clean Custom Upload Button with comfortable spacing --}}
                        <button type="button" onclick="document.getElementById('profile-input').click();" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition">
                            <i class="fa-solid fa-upload text-gray-400"></i> Change Photo
                        </button>

                        <div id="file-name" class="mt-2 text-xs text-gray-500 font-medium hidden"></div>

                        @error('profile_picture')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Full Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Address --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-lg border border-gray-200 px-3.5 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('phone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
            <a href="{{ route('user.profile') }}" class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="rounded-lg bg-[#1E3A8A] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-900 transition">Save Changes</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('profile-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('profile-preview');
        const placeholder = document.getElementById('profile-placeholder');
        const fileNameDisplay = document.getElementById('file-name');

        if (file) {
            fileNameDisplay.textContent = 'Selected file: ' + file.name;
            fileNameDisplay.classList.remove('hidden');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection