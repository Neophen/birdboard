<article class="card">
	<a href="{{ $project->path() }}">
		<h3 title="{{ $project->title }}"
			class="text-2xl border-l-4 border-blue-400 -mx-4 p-4">{{ Illuminate\Support\Str::limit($project->title, 30) }}
		</h3>
	</a>
	<p title="{{ $project->description }}"
		class="pt-4 text-gray-500">{{ Illuminate\Support\Str::limit($project->description) }}</p>
	<form action="{{ $project->path() }}"
		method="post"
		class="flex justify-end mt-4">
		@csrf
		@method('DELETE')
		<button type="submit"
			class="text-xs p-2 leading-none border border-red-500 hover:bg-red-500 hover:text-white rounded">Delete</button>
	</form>
</article>
