@extends('layouts.app')

@section('title', 'Add Maintenance Request')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
        <h1 class="text-xl font-semibold">Add Maintenance Request</h1>
        <p class="mt-1 text-sm text-blue-200">Create a new maintenance request</p>
    </section>

    <form method="POST" action="{{ route('maintenance.store') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                Please correct the highlighted form details and try again.
            </div>
        @endif
        <div class="grid gap-5">
            <label class="text-sm font-medium text-slate-700">
                Locker
                <select name="locker_id" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Select locker</option>
                    @foreach(\App\Models\Locker::all() as $locker)
                        <option value="{{ $locker->id }}">Locker #{{ $locker->id }} ({{ ucfirst($locker->type) }})</option>
                    @endforeach
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Description
                <textarea name="description" required rows="4" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"></textarea>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Priority
                <select name="priority" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="low">Low</option>
                    <option value="normal">Normal</option>
                    <option value="high">High</option>
                </select>
            </label>
            <label class="text-sm font-medium text-slate-700">
                Status
                <select name="status" required class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </label>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('maintenance.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
            <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Create request</button>
        </div>
    </form>
</div>
@endsection
