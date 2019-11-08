@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <header class="flex items-end mb-8">
        <p class="text-sm font-light text-gray-500 mr-4"><a href="{{ route('projects.index') }}">{{ __('My projects') }}</a> /
            {{ $project->title }}</p>
        <a href="{{ route('projects.edit', $project) }}"
            class="btn text-gray-500 mr-auto">{{ __('Add task') }}</a>
        <a href="{{ route('projects.edit', $project) }}"
            class="btn text-gray-500">{{ __('Edit Project') }}</a>
    </header>
    <div class="lg:flex -mx-3 items-start">
        <main class="lg:w-3/4 px-3">
            <div class="mb-8">
                <h2 class="text-md text-gray-500 mr-auto mb-4">{{ __('Tasks') }}</h2>
                @forelse ($project->tasks as $task)
                <div class="card mb-3">
                    <p>{{ $task->body }}</p>
                </div>
                @empty
                <div class="card mb-3">
                    <p>{{ __('No tasks on this project yet') }}</p>
                </div>
                @endforelse
            </div>
            <div>
                <h2 class="text-md text-gray-500 mr-auto mb-4">{{ __('General notes') }}</h2>
                <textarea class="card w-full highlight"
                    rows="10"></textarea>
            </div>
        </main>
        <div class="lg:w-1/4 px-3 mt-8 lg:mt-0">
            @include('projects.card')
        </div>
    </div>
</div>
@endsection
