@extends('layouts.app')

@section('content')
<section class="container mx-auto">
	<div class="rounded bg-gray-200 p-4 my-4">
		<h1 class="text-2xl">{{ $project->title }}</h1>
		<p>{{ $project->description }}</p>
	</div>
	<a class="btn mt-4"
		href="{{ route('projects.index') }}">Go back</a>
</section>
@endsection
