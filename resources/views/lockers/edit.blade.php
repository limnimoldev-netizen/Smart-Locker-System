@extends('layouts.app')

@section('title', 'Edit Locker')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <h1 class="text-xl font-semibold">Edit Locker</h1>
        <p class="mt-1 text-sm text-blue-200">Update Locker #{{ $locker->id }}</p>
    </section>

    <form method="POST" action="{{ route('lockers.update', $locker) }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div class="grid gap-5">
            <label class="text-sm font-medium text-slate-700">
                Location
                <select name="location_id" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Select location</option>
                    @foreach(\App\Models\Location::all() as $location)
                        <option value="{{ $location->id }}" @selected(old('location_id', $locker->location_id) == $location->id)>{{ $location->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Type
                <select name="type" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="small" @selected(old('type', $locker->type) === 'small')>Small</option>
                    <option value="medium" @selected(old('type', $locker->type) === 'medium')>Medium</option>
                    <option value="large" @selected(old('type', $locker->type) === 'large')>Large</option>
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Status
                <select name="status" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="available" @selected(old('status', $locker->status) === 'available')>Available</option>
                    <option value="in_use" @selected(old('status', $locker->status) === 'in_use')>In Use</option>
                    <option value="maintenance" @selected(old('status', $locker->status) === 'maintenance')>Maintenance</option>
                </select>
            </label>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('lockers.show', $locker) }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Save changes</button>
        </div>
    </form>
</div>
@endsection
