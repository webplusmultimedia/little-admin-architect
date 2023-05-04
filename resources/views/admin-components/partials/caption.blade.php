@if($caption)
    <div {{ $attributes->merge([
        'class' => 'text-sm text-gray-500 mt-1',
    ]) }}>{!! $caption !!}</div>
@endif
