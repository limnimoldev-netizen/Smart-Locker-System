@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Usage History</h1>
        <a href="/user/profile" class="text-sm text-blue-600 hover:underline">← Back to Profile</a>
    </div>

    {{-- Filter --}}
    <div class="flex gap-2 mb-4">
        @php $current = request('status'); @endphp
        @foreach ([null => 'All', 'active' => 'Active', 'completed' => 'Completed'] as $value => $label)
            <a href="{{ route('user.usage-history', $value ? ['status' => $value] : []) }}"
               class="px-4 py-1.5 rounded-full text-sm border
                      {{ $current == $value ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- List --}}
    <div class="bg-white rounded-xl shadow divide-y">
        @forelse ($usages as $usage)
            <div class="p-4 flex items-center justify-between">
                <div>
                    <p class="font-medium text-gray-800">
                        Locker #{{ $usage->locker->locker_number }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $usage->locker->location->name ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        {{ $usage->started_at->format('d M Y, H:i') }}
                        →
                        {{ $usage->release_at ? $usage->release_at->format('d M Y, H:i') : 'In use' }}
                        · {{ $usage->duration }}
                    </p>
                </div>

                <span class="px-3 py-1 rounded-full text-xs font-medium
                    {{ $usage->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst($usage->status) }}
                </span>
            </div>
        @empty
            <div class="p-10 text-center text-gray-400">
                មិនទាន់មានប្រវត្តិប្រើប្រាស់នៅឡើយទេ
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $usages->links() }}
    </div>
</div>
@endsection