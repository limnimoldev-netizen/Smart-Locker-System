@extends('layouts.app')

@section('title', 'Manage Lockers')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Manage Lockers</h1>
            <p class="text-gray-500 mt-1">View and manage all lockers across locations</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fa-solid fa-box text-xl text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Lockers</p>
                    <p class="text-2xl font-bold text-gray-900">162</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fa-solid fa-check text-xl text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Available</p>
                    <p class="text-2xl font-bold text-gray-900">89</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <i class="fa-solid fa-lock text-xl text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">In Use</p>
                    <p class="text-2xl font-bold text-gray-900">45</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                    <i class="fa-solid fa-screwdriver-wrench text-xl text-amber-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Maintenance</p>
                    <p class="text-2xl font-bold text-gray-900">28</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <select class="w-full sm:w-48 px-4 py-2 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Locations</option>
                    <option value="1">Central Mall</option>
                    <option value="2">Downtown Library</option>
                    <option value="3">Sports Complex</option>
                </select>
                <select class="w-full sm:w-48 px-4 py-2 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="in_use">In Use</option>
                    <option value="maintenance">Maintenance</option>
                </select>
                <input type="text" placeholder="Search locker..." class="w-full sm:w-64 px-4 py-2 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Locker #</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Last Updated</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">L-101</td>
                        <td class="px-6 py-4 text-gray-700">Central Mall</td>
                        <td class="px-6 py-4 text-gray-700">Standard</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Available</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">2 hours ago</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Maintenance">
                                    <i class="fa-solid fa-screwdriver-wrench"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">L-102</td>
                        <td class="px-6 py-4 text-gray-700">Central Mall</td>
                        <td class="px-6 py-4 text-gray-700">Large</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">In Use</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">1 hour ago</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Maintenance">
                                    <i class="fa-solid fa-screwdriver-wrench"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">L-201</td>
                        <td class="px-6 py-4 text-gray-700">Downtown Library</td>
                        <td class="px-6 py-4 text-gray-700">Standard</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Maintenance</span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">5 hours ago</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Maintenance">
                                    <i class="fa-solid fa-screwdriver-wrench"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
            <p class="text-sm text-gray-500">Showing 1 to 3 of 162 entries</p>
            <div class="flex gap-2">
                <button class="px-3 py-1 border border-gray-200 rounded-lg text-sm text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 border border-gray-200 rounded-lg text-sm text-gray-500 hover:bg-gray-50">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection