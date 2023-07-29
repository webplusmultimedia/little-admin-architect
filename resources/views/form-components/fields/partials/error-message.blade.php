@props([
	'message' => null
])
@if($message)
    <div {{ $attributes->merge(['class' => 'text-sm text-error-600 dark:text-error-400/80 mt-1 col-span-full']) }}>{{ $message }}</div>
@endif
