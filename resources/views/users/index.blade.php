@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6 bg-[#F8F9FA]">

        <section class="rounded-lg bg-[#1E3A8A] px-4 py-5 text-white shadow-md sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h1 class="text-xl font-semibold">Users & Usage</h1>
                        <p class="text-base text-blue-200">Manage system users and track usage</p>
                    </div>
                </div>

                <a href="#" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#111827] shadow-sm hover:bg-[#C7D2EF] sm:w-auto">
                    <i class="fa-solid fa-plus text-xs" aria-hidden="true"></i>
                    Add user
                </a>
            </div>
        </section>

        <section class="grid gap-8 sm:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white px-5 py-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600">Total users</p>
                    <i class="fa-solid fa-users text-blue-700" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">{{ $totalUsers }}</p>
                <p class="text-base text-slate-500">Across all branches</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white px-5 py-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600">Active now</p>
                    <i class="fa-solid fa-circle-check text-emerald-600" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">{{ $activeUsers }}</p>
                <p class="text-base text-slate-500">Customers online</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white px-5 py-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-base text-slate-600">Total sessions</p>
                    <i class="fa-solid fa-rotate text-sky-600" aria-hidden="true"></i>
                </div>
                <p class="mt-2 text-2xl font-semibold">{{ $totalSessions }}</p>
                <p class="text-base text-slate-500">This month</p>
            </div>
        </section>

        <section class="bg-white px-5 py-5 rounded-lg border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between gap-3 border-b border-slate-200 pb-5">
                <div>
                    <h1 class="text-xl font-semibold">User Lists</h1>
                    <p class="text-base text-slate-500">View and manage system users.</p>
                </div>

                <label class="relative block w-40 sm:w-44">
                    <span class="sr-only">Search users</span>
                    <i class="fa-solid fa-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true"></i>
                    <input type="search" placeholder="Search user" class="w-full rounded-lg border border-slate-200 py-2 pl-8 pr-3 text-base text-slate-700 outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </label>
            </div>

            <div class="-mx-5 mt-4 overflow-x-auto">
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
                                        <button type="button" aria-label="Edit user" class="hover:text-blue-700"><i class="fa-solid fa-pen" aria-hidden="true"></i></button>
                                        <button type="button" aria-label="Delete user" class="hover:text-red-600"><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
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
