@extends('layouts.app')

@section('title', 'Add Locker')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <h1 class="text-xl font-semibold">Add Locker</h1>
        <p class="mt-1 text-sm text-blue-200">Create a new locker</p>
    </section>

    <form method="POST" action="{{ route('lockers.store') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                Please correct the highlighted form details and try again.
            </div>
        @endif
        <div class="grid gap-5">
            <label class="text-sm font-medium text-slate-700">
                Location
                <select name="location_id" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Select location</option>
                    @foreach(\App\Models\Location::all() as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Type
                <select name="type" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Status
                <select name="status" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="available">Available</option>
                    <option value="in_use">In Use</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </label>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('lockers.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Create locker</button>
        </div>
    </form>
</div>
@endsection
