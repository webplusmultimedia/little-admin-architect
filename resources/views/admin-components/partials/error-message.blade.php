@if($message)
    <div {{ $attributes->merge(['class' => 'text-sm text-error-500']) }}>{{ $message }}</div>
@endif
