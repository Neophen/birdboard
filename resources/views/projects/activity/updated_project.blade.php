@if(count($activity->changes['after']) == 1)
<p class="text-sm">"{{ key($activity->changes['after']) }}" <span class="text-gray-500 font-light">{{ __('updated') }}</span></p>
@else
<p class="text-sm">{{ __('Project updated') }}</p>
@endif
