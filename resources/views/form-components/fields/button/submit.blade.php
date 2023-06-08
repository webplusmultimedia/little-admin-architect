<button type="submit" {!! $attributes->merge([
    'class' => 'flex justify-center items-center space-x-1 btn btn-medium' . ($attributes->has('class') ? null : ' btn-primary')
]) !!}
    {{ $attributes->except('class') }}
>
    {{ $slot->isNotEmpty() ? $slot : __('Submit') }}
</button>
