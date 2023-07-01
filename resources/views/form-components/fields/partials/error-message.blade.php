@props([
	'message' => null
])
@if($message)
    <div {{ $attributes->merge(['class' => 'text-sm text-error-500 mt-1 col-span-full']) }}>{{ $message }}</div>
@endif
