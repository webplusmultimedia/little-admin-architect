@if($message)
    <div {{ $attributes->merge(['class' => 'text-sm text-error-500 mt-1']) }}>{{ $message }}</div>
@endif
