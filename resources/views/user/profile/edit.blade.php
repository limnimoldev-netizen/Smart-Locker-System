@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <h1 class="text-xl font-semibold">Edit Profile</h1>
        <p class="mt-1 text-sm text-blue-200">Update your account details</p>
    </section>

    <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="name"
                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="email"
                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-md bg-blue-900 px-5 py-2 font-medium text-white hover:bg-blue-800">Save changes</button>
            <a href="{{ route('user.profile') }}" class="rounded-md border border-gray-300 px-5 py-2 font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>
@endsection