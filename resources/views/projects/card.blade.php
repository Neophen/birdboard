<article class="card">
	<a href="{{ $project->path() }}"
		class="block absolute inset-0">
	</a>
	<h3 title="{{ $project->title }}"
		class="text-2xl border-l-4 border-blue-400 -mx-4 p-4">{{ Illuminate\Support\Str::limit($project->title, 30) }}
	</h3>
	<p title="{{ $project->description }}"
		class="pt-4 text-gray-500">{{ Illuminate\Support\Str::limit($project->description) }}</p>
</article>
