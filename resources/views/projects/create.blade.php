@extends('layouts.app')

@section('content')
<div class="mt-4 w-full max-w-lg mx-auto">
	<h1 class="text-2xl text-center text-gray-500 mb-6">{{ __('Create project') }}</h1>
	<form action="{{ route('projects.store') }}"
		method="post"
		class="bg-white rounded px-8 py-6 shadow-md">
		@csrf
		<div class="mb-4">
			<label class="label"
				for="title">
				{{ __('Title') }}
			</label>
			<input name="title"
				id="title"
				type="text"
				value="{{ old('title') }}"
				required
				placeholder="{{ __('Go on vacation to maljorka') }}"
				autocomplete="off"
				class="input @error('title') border-red-500 @enderror">
			@error('title')
			<p role="alert"
				class="input__error">{{ $message }}</p>
			@enderror
		</div>
		<div class="mb-4">
			<label class="label"
				for="title">
				{{ __('Description') }}
			</label>
			<textarea name="description"
				id="description"
				value="{{ old('description') }}"
				required
				placeholder="{{ __('Plan the best vacation of our lives') }}"
				class="input @error('description') border-red-500 @enderror"
				cols="30"
				rows="10"
				autocomplete="off">{{ old('description') }}</textarea>
			@error('description')
			<p role="alert"
				class="input__error">{{ $message }}</p>
			@enderror
		</div>

		<div class="flex justify-end">

			<a href="{{ route('projects.index') }}"
				class="btn mr-4">Cancel</a>
			<button type="submit"
				class="btn">Save</button>
		</div>
	</form>
</div>
@endsection
