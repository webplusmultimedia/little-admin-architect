<a {!! $attributes->merge([
    'class' => 'inline-flex items-center space-x-2 btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'title' => $attributes->has('title') ? $attributes->get('title') : ($slot->isNotEmpty() ? strip_tags($slot) : null),
    'role' => 'button',
    'href' => $url,
]) !!}>
    {{ $slot }}
</a>