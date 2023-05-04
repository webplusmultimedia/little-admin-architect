@if($label)
    <div class="mb-2">
        <label {{ $attributes->merge(['for' => $id,'class' => 'inline-flex gap-x-1 text-lg font-medium text-slate-700 ']) }}>
            {{ $label }}
            @if($showRequired)
                <span class="whitespace-nowrap">
                    <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
                 </span>
            @endif
        </label>
    </div>
@endif
