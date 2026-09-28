@extends('layouts.app')

@section('title', 'Edit Locker')
@section('content')
    <div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8 flex justify-center">
        
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-sm border border-slate-200">
            
            <!-- Card Header -->
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50">
                <h2 class="text-2xl font-bold text-slate-900">Edit Locker</h2>
                <p class="text-sm text-slate-500 mt-1">Update the location, address, or status for this locker.</p>
            </div>

            <!-- Form Body -->
            <form action="{{ route('lockers.update', $locker->locker_id) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Error Alert (Now using FontAwesome) -->
                @if ($errors->any())
                    <div class="p-4 rounded-lg bg-red-50 border border-red-200 flex items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 mt-0.5"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-red-800">There were errors with your submission</h3>
                            <ul class="list-disc pl-5 mt-2 text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Locker ID (Now using FontAwesome lock icon) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Locker Code</label>
                    <div class="relative rounded-md shadow-sm max-w-xs">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400 text-sm"></i>
                        </div>
                        <input type="text" value="{{ $locker->locker_id ?? $locker->id }}" disabled 
                               class="block w-full pl-10 pr-3 py-2.5 rounded-md border border-slate-200 bg-slate-50 text-slate-500 font-mono text-sm cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Location -->
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Location Name</label>
                        <input type="text" name="location" value="{{ old('location', $locker->location?->name ?? $locker->location?->location_name) }}" 
                               class="block w-full rounded-md border border-slate-300 shadow-sm text-sm text-slate-900 p-2.5 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 focus:outline-none transition-colors placeholder:text-slate-400"
                               placeholder="e.g. Phnom Penh Railway Station">
                        @error('location') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Opening Hours -->
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Opening Hours</label>
                        <input type="text" name="opening_hours" value="{{ old('opening_hours', $locker->location?->opening_hours) }}" 
                               class="block w-full rounded-md border border-slate-300 shadow-sm text-sm text-slate-900 p-2.5 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 focus:outline-none transition-colors placeholder:text-slate-400"
                               placeholder="e.g. Daily 24/7">
                        @error('opening_hours') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Address</label>
                        <input type="text" name="address" value="{{ old('address', $locker->location?->address) }}" 
                               class="block w-full rounded-md border border-slate-300 shadow-sm text-sm text-slate-900 p-2.5 focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 focus:outline-none transition-colors placeholder:text-slate-400"
                               placeholder="e.g. 663 Shanahan Villages, Starkshire">
                        @error('address') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status Dropdown (Custom Alpine.js + FontAwesome) -->
                    <!-- Status Dropdown (Custom Alpine.js + FontAwesome) -->
                    <div class="sm:col-span-2 relative" 
                        x-data="{ 
                            open: false, 
                            // Safely pass the Enum value to Alpine
                            selected: @js(old('status', $locker->status instanceof \BackedEnum ? $locker->status->value : (is_object($locker->status) ? $locker->status->name : $locker->status))),
                            options: [
                                { value: 'Available', label: 'Available' },
                                { value: 'Occupied', label: 'Occupied' },
                                { value: 'Cleaning', label: 'Cleaning' },
                                { value: 'Maintenance', label: 'Under Maintenance' },
                                { value: 'OutOfService', label: 'Out of Service' }
                            ]
                        }">
                        
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status</label>
                        <input type="hidden" name="status" :value="selected">

                        <!-- Trigger Button -->
                        <button type="button" @click="open = !open" 
                                class="relative w-full cursor-default rounded-md border border-slate-300 bg-white py-2.5 pl-3 pr-10 text-left shadow-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20 sm:text-sm transition-colors"
                                :aria-expanded="open">
                            
                            <!-- Updated x-text: Falls back to 'selected' if no matching label is found -->
                            <span class="block truncate text-slate-900" x-text="options.find(o => o.value === selected)?.label || selected || 'Select Status'"></span>
                            
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                            </span>
                        </button>
                        
                        <!-- Dropdown Menu (NOW OPENS UPWARDS) -->
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute z-50 bottom-full mb-2 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm border border-slate-200"
                            style="display: none;">
                            <template x-for="option in options" :key="option.value">
                                <li @click="selected = option.value; open = false" 
                                    class="relative cursor-pointer select-none py-2.5 pl-3 pr-9 text-slate-700 hover:bg-slate-50 hover:text-blue-900 transition-colors"
                                    :class="{'bg-blue-50 text-blue-900 font-semibold': selected === option.value}">
                                    <span class="block truncate" x-text="option.label"></span>
                                    <span x-show="selected === option.value" class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-600">
                                        <i class="fa-solid fa-check text-sm"></i>
                                    </span>
                                </li>
                            </template>
                        </div>
                        @error('status') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Form Actions (FontAwesome save icon) -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('lockers.index') }}" 
                    class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 border border-slate-300 hover:bg-slate-50 hover:text-slate-900 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center rounded-md bg-blue-900 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2">
                        <i class="fa-solid fa-check mr-2"></i> Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection