@props([
	'colSpan' =>'col-span-full',
	'padding' =>'py-4',
	'style' => null
])
<div {{ $attributes->class([$colSpan,'flex space-x-2'])  }} @style([
        $style
])
>
    {{ $slot }}
</div>
