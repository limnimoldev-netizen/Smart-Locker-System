@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
<div class="flex items-center justify-between w-full">
    <div class="">
        <h1 class="text-xl md:text-2xl font-black uppercase">Operations Dashboard</h1>
        <p class="text-gray-400 text-xs md:text-sm">Real-time overview of your locker network performance.</p>
    </div>
</div>
<!-- 4MiniDashboard -->
<div class="grid grid-cols-2 md:grid-cols-4 items-center mt-5 gap-4 md:gap-6">
    @foreach ($stats as $stat)
    <div class="bg-gray-200 p-4 rounded-lg flex flex-col gap-1 border border-gray-100">
        <div class="flex items-center justify-between">
            <p class="text-xs md:text-sm text-gray-500">{{ $stat['label'] }}</p>
            <div class="w-5 h-5 {{ $stat['class'] }} rounded-lg p-4 md:flex items-center justify-center hidden">
                <i class="fa-solid {{ $stat['icon'] }} text-md"></i>
            </div>
        </div>
        <h1 class="font-black {{ $stat['class_value'] }} text-2xl md:text-4xl font-display">{{ $stat['value'] }}</h1>
        @if (!empty($stat['trend']))
        <span class="text-xs {{ $stat['class_trend'] }} flex items-center gap-1">
            <i class="fa-solid {{ $stat['trend_icon'] ?? 'fa-circle-info' }}"></i>{{ $stat['trend'] }}
        </span>
        @endif
    </div>
    @endforeach
</div>
<div class="bg-white rounded-lg shadow overflow-hidden mt-5">
    <table class="min-w-full divide-y divide-gray-200">
        
        <!-- TABLE HEADER -->
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Locker ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>

        <!-- TABLE BODY -->
        <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">LCK-001</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Central Mall</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">Active</td>
            </tr>
        </tbody>

    </table>
</div>
@endsection

