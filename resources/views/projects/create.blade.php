@extends('layouts.app')

@section('content')
<div class="mt-4 w-full max-w-lg mx-auto">
	<h1 class="text-2xl text-center text-gray-500 mb-6">{{ __("Let's create something new") }}</h1>
	<form action="{{ route('projects.store') }}"
		method="post"
		class="bg-white rounded px-8 py-6 shadow-md">
		@include('projects._form', [
		'project' => new App\Project,
		'buttonText' => 'Create project',
		])
	</form>
</div>
@endsection
