<a {!! $attributes->merge([
    'class' => 'inline-flex items-center space-x-2 btn btn-medium' . ($attributes->has('class') ? null : ' btn-primary'),
    'title' => $attributes->has('title') ? $attributes->get('title') :null,
    'role' => 'button',
    'href' => $url,
]) !!}>
    {{ $slot }}
</a>
