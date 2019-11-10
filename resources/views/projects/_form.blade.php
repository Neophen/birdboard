@csrf
<div class="mb-4">
	<label class="label"
		for="title">
		{{ __('Title') }}
	</label>
	<input name="title"
		id="title"
		type="text"
		value="{{ old('title') ?: $project->title }}"
		required
		placeholder="{{ __('Give it a name') }}"
		autocomplete="off"
		autofocus
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
		required
		placeholder="{{ __('Describe what problems it will solve and how it will help others?') }}"
		class="input @error('description') border-red-500 @enderror"
		cols="30"
		rows="10"
		autocomplete="off">{{ old('description') ?: $project->description }}</textarea>
	@error('description')
	<p role="alert"
		class="input__error">{{ $message }}</p>
	@enderror
</div>

<div class="flex justify-end">

	<a href="{{ $project->path() }}"
		class="btn mr-4">{{ __('Cancel') }}</a>
	<button type="submit"
		class="btn">{{ __($buttonText) }}</button>
</div>
