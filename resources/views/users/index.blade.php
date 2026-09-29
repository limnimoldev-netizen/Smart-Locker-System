@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="mx-auto max-w-6xl space-y-4 bg-[#F8F9FA] sm:space-y-6">

        <section class="rounded-lg bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:px-8 sm:py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h1 class="text-xl font-semibold">Users & Usage</h1>
                        <p class="text-sm text-blue-200 sm:text-base">Manage system users and track usage</p>
                    </div>
                </div>

                <a href="{{ route('users.create') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] sm:w-auto">
                    <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                    Add user
                </a>
            </div>
        </section>

        @if (session('success'))
            <div class="rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <section class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 sm:text-base">Total users</p>
                    
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                        <i class="fa-solid fa-users text-blue-700" aria-hidden="true"></i>
                    </div>
                </div>
                <p class="mt-2 text-2xl text-[#1E3A8A] font-semibold">{{ $totalUsers }}</p>
                <p class="text-sm text-[#1E3A8A] sm:text-base">Across all branches</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 sm:text-base">Active now</p>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-green-600">
                        <i class="fa-solid fa-circle-check text-green-600" aria-hidden="true"></i>
                    </div>
                </div>
                <p class="mt-2 text-2xl text-green-700 font-semibold">{{ $activeUsers }}</p>
                <p class="text-sm text-green-500 sm:text-base">Registered customers</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white px-4 py-4 shadow-sm sm:px-5 sm:py-5 sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-600 sm:text-base">Total sessions</p>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <i class="fa-solid fa-rotate text-red-600" aria-hidden="true"></i>
                    </div>
                </div>
                <p class="mt-2 text-2xl text-red-700 font-semibold">{{ $totalSessions }}</p>
                <p class="text-sm text-red-500 sm:text-base">Locker usage records</p>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white px-3 py-4 shadow-sm sm:px-5 sm:py-5">
            <div class="flex flex-col gap-3 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-lg font-semibold sm:text-xl">User Lists</h1>
                    <p class="text-sm text-slate-500 sm:text-base">View and manage system users.</p>
                </div>

            </div>

            <div class="mt-4 sm:hidden">
                @forelse ($users as $user)
                    <div class="mb-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-700">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900">{{ $user->name }}</p>
                                    <p class="text-[11px] text-slate-500">ID: #{{ $user->id }}</p>
                                </div>
                            </div>
                            <span class="rounded-full {{ $user->role === 'admin' ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-700' }} px-2.5 py-1 text-[10px] font-medium">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <div class="mt-3 space-y-2 text-sm text-slate-600">
                            <p><span class="font-medium text-slate-700">Email:</span> {{ $user->email }}</p>
                            <p><span class="font-medium text-slate-700">Sessions:</span> {{ $user->id * 3 }}</p>
                        </div>

                        <div class="mt-4 flex justify-end gap-3 border-t border-slate-200 pt-3 text-slate-400">
                            <a href="{{ route('users.edit', $user) }}" aria-label="Edit user" class="hover:text-blue-700"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" aria-label="Delete user" class="hover:text-red-600"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-5 text-center text-sm text-slate-500">
                        No users found.
                    </div>
                @endforelse
            </div>

            <div class="hidden sm:block -mx-5 mt-4 overflow-x-auto">
                <table class="w-full min-w-[700px] text-left text-sm">
                    <thead class="border-y border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th scope="col" class="px-5 py-3 font-semibold">User</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Email</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Role</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Status</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Sessions</th>
                            <th scope="col" class="px-5 py-3 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($users as $user)
                            <tr class="text-slate-700 transition-colors hover:bg-slate-50">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-700">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900">{{ $user->name }}</p>
                                            <p class="text-[11px] text-slate-500">ID: #{{ $user->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">{{ $user->email }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full {{ $user->role === 'admin' ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-700' }} px-2.5 py-1 text-xs font-medium">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Active</span>
                                </td>
                                <td class="px-5 py-4">{{ $user->id * 3 }}</td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex justify-end gap-3 text-slate-400">
                                        <a href="{{ route('users.edit', $user) }}" aria-label="Edit user" class="hover:text-blue-700"><i class="fa-solid fa-pen" aria-hidden="true"></i></a>
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" aria-label="Delete user" class="hover:text-red-600"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-8 text-center text-sm text-slate-500">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
@endsection
