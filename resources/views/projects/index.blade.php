@extends('layouts.app')

@section('content')
<section class="container mx-auto">


	<div class="flex items-center mb-4">
		<h1 class="text-3xl mr-auto">Birdboard</h1>
		<a href="{{ route('projects.create') }}" class="btn">New Project</a>
	</div>

	<ul class="">
		@forelse($projects as $project)
		<li>
			<a href="{{ $project->path() }}" class="underline hover:text-teal-500">
				{{ $project->title }}
			</a>
		</li>
		@empty
		<p>No projects yet.</p>
		@endforelse
	</ul>
</section>
@endsection
