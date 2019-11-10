@extends('layouts.app')

@section('content')
<div class="mt-4 w-full max-w-lg mx-auto">
	<h1 class="text-2xl text-center text-gray-500 mb-6">{{ __('Edit project') }}</h1>
	<form action="{{ $project->path() }}"
		method="post"
		class="bg-white rounded px-8 py-6 shadow-md">
		@method('PATCH')
		@include('projects._form', [
		'buttonText' => 'Update project',
		])
	</form>
</div>
@endsection
