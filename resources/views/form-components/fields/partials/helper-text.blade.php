@props([
	'text' => null
])
@if($text)
    <div {{ $attributes->merge([
        'class' => 'text-sm text-gray-500 mt-1 col-span-full',
    ]) }}>{!! $text !!}</div>
@endif
