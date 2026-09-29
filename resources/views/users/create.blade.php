@extends('layouts.app')

@section('title', 'Add User')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6">
        <section class="rounded-lg bg-[#1E3A8A] px-6 py-5 text-white shadow-md sm:px-8">
            <h1 class="text-xl font-semibold">Add User</h1>
            <p class="mt-1 text-sm text-blue-200">Create a new system user</p>
        </section>

        <form method="POST" action="{{ route('users.store') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @include('users.form', ['submitLabel' => 'Create user'])
        </form>
    </div>
@endsection