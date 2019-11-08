@extends('layouts.app')

@section('content')
<div class="container mx-auto">
	<header class="flex items-end mb-8">
		<p class="text-sm font-light text-gray-500 mr-auto">{{ __('My projects') }}</p>
		<a href="{{ route('projects.create') }}"
			class="btn text-gray-500">{{ __('New Project') }}</a>
	</header>
	<main>

		<ul class="flex flex-wrap -mx-3">
			@forelse($projects as $project)
			<li class="w-full md:w-1/2 xl:w-1/3 px-3 mb-6">
				@include('projects.card')
			</li>
			@empty
			<p>{{ __('No projects yet') }}</p>
			@endforelse
		</ul>
	</main>
</div>
@endsection
