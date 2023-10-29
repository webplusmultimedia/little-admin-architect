@props([
	'columns' => 1
])
<div @class([
    'grid gap-x-6 gap-y-4',
    'md:grid-cols-1' => $columns === 1,
    'md:grid-cols-2' => $columns === 2,
    'md:grid-cols-3' => $columns === 3,
    'md:grid-cols-2 xl:grid-cols-4' => $columns === 4,
    ])
>
    {{ $slot }}
</div>
