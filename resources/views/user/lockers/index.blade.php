@extends('layouts.app')

@section('title', 'Available Lockers')

@section('content')
<section class="rounded-xl bg-[#1E3A8A] px-4 py-4 text-white shadow-md sm:px-8 sm:py-5">
	<h1 class="text-xl font-semibold">Available lockers</h1>
	<p class="mt-1 text-sm text-blue-200">{{ $location->name }}</p>
</section>

<div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
	@forelse ($lockers as $locker)
		<article class="rounded-xl border border-gray-200 bg-white p-5">
			<h2 class="text-lg font-semibold text-gray-900">Locker {{ $locker->locker_number }}</h2>
			<p class="mt-1 text-sm text-gray-500">{{ ucfirst($locker->type) }} · Available</p>
			<a href="{{ route('user.lockers.confirm', $locker) }}" class="mt-4 inline-flex rounded-lg bg-blue-900 px-4 py-2 font-semibold text-white hover:bg-blue-950">
				Select locker
			</a>
		</article>
	@empty
		<p class="text-sm text-gray-500">There are no available lockers at this location.</p>
	@endforelse
</div>
@endsection

