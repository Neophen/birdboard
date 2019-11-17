@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <header class="flex items-end justify-between mb-8">
        <p class="text-sm font-light text-gray-500 mr-4"><a
                href="{{ route('projects.index') }}">{{ __('My projects') }}</a> /
            {{ $project->title }}</p>
        <a href="{{ route('projects.edit', $project) }}"
            class="btn text-gray-500">{{ __('Edit Project') }}</a>
    </header>
    <div class="lg:flex -mx-3 items-start">
        <main class="lg:w-3/4 px-3">
            <div class="mb-8">
                <h2 class="text-md text-gray-500 mr-auto mb-4">{{ __('Tasks') }}</h2>
                <form action="{{ $project->path() . '/tasks'  }}"
                    method="POST">
                    @csrf
                    <input name="body"
                        type="text"
                        value="{{ old('email') }}"
                        placeholder="{{ __('Add a new task...') }}"
                        autofocus
                        required
                        autocomplete="off"
                        class="input @error('body') border-red-500 @enderror">
                </form>
                @foreach ($project->tasks as $task)
                <div class="card mb-3">
                    <form action="{{ $task->path() }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex">
                            <input name="body"
                                value="{{ $task->body }}"
                                class="h-full w-full {{ $task->completed ? 'text-gray-500 line-through' : '' }}">
                            <input name="completed"
                                type="checkbox"
                                {{ $task->completed ? 'checked' : '' }}
                                onchange="this.form.submit()">
                        </div>
                    </form>
                </div>
                @endforeach

            </div>
            <div>
                <h2 class="text-md text-gray-500 mr-auto mb-4">{{ __('General notes') }}</h2>
                <form action="{{ $project->path() }}"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes"
                        class="card w-full highlight mb-4"
                        placeholder="{{ __("You can write anything here, be brave!") }}"
                        rows="10">{{ $project->notes }}</textarea>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('Save notes') }}
                    </button>

                </form>
            </div>
        </main>
        <div class="lg:w-1/4 px-3 mt-8 lg:mt-0">
            @include('projects._card')
            @include('projects.activity.card')
        </div>
    </div>
</div>

@endsection
