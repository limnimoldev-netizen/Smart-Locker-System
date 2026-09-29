@extends('layouts.app')

@section('title', 'Edit Maintenance Request')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <h1 class="text-xl font-semibold">Edit Maintenance Request</h1>
        <p class="mt-1 text-sm text-blue-200">Update Request #{{ $maintenance->id }}</p>
    </section>

    <form method="POST" action="{{ route('maintenance.update', $maintenance) }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div class="grid gap-5">
            <label class="text-sm font-medium text-slate-700">
                Locker
                <select name="locker_id" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Select locker</option>
                    @foreach(\App\Models\Locker::all() as $locker)
                        <option value="{{ $locker->id }}" @selected(old('locker_id', $maintenance->locker_id) == $locker->id)>Locker #{{ $locker->id }} ({{ ucfirst($locker->type) }})</option>
                    @endforeach
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Description
                <textarea name="description" required rows="4" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description', $maintenance->description) }}</textarea>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Priority
                <select name="priority" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="low" @selected(old('priority', $maintenance->priority) === 'low')">Low</option>
                    <option value="normal" @selected(old('priority', $maintenance->priority) === 'normal')">Normal</option>
                    <option value="high" @selected(old('priority', $maintenance->priority) === 'high')">High</option>
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Status
                <select name="status" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="pending" @selected(old('status', $maintenance->status) === 'pending')">Pending</option>
                    <option value="in_progress" @selected(old('status', $maintenance->status) === 'in_progress')">In Progress</option>
                    <option value="completed" @selected(old('status', $maintenance->status) === 'completed')">Completed</option>
                </select>
            </label>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('maintenance.show', $maintenance) }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Save changes</button>
        </div>
    </form>
</div>
@endsection
