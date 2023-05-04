@if($label)
    <div class="mb-2">
        <label {{ $attributes->merge(['for' => $id,'class' => 'text-sm font-medium text-slate-700 ']) }}>{{ $label }}</label>
    </div>

@endif
