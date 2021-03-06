@if ($project->activity)
<div class="card mt-4">
	<ul>
		@foreach ($project->activity as $activity)
		<li class="{{ $loop->last ? '' : 'mb-1' }}">
			@include("projects.activity.{$activity->description}")
			<p class="text-xs text-gray-400 font-light">{{ $activity->username() }}, {{ $activity->created_at->diffForHumans() }}</p>
		</li>
		@endforeach
	</ul>
</div>
@endif
