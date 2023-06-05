<button {!! $attributes->merge([
    'class' => 'flex justify-center items-center space-x-1 btn' . ($attributes->has('class') ? null : ' btn-primary'),
    'type' => 'submit',
    'title' => $attributes->has('title')
        ? $attributes->get('title')
        : null,
]) !!}
    {{ $attributes->has('wire')?:$attributes->get('wire') }}
>
    {{ $slot->isNotEmpty() ? $slot : __('Submit') }}
</button>
