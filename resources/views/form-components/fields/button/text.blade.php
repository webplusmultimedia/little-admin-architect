<button {!! $attributes->merge([
    'class' => 'flex justify-center items-center space-x-1 btn btn-medium',
    'type' => 'submit',
]) !!}
    {{ $attributes->has('wire')?:$attributes->get('wire') }}
        @click.stop="$dispatch('close.modal')"
>
    {{ $slot->isNotEmpty() ? $slot : __('Submit') }}
</button>
