@if(count($activity->changes['after']) == 1)
<p class="text-sm"><span class="text-gray-500">You updated the</span> {{ key($activity->changes['after']) }}</p>
@else
<p class="text-sm text-gray-500">You updated the project</p>
@endif
