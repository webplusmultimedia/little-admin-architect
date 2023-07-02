@props([
	    'label' => NULL,
        'isRequired' => false,
        'id' => null
])
<div @class(["mb-1"])>
    <label {{ $attributes->except(['isRequired'])->merge(['for'=>$id]) }} >
        {{ $slot }}
        {{ $label }}
        @if($isRequired)
            <span class="whitespace-nowrap">
                    <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
                 </span>
        @endif
    </label>
</div>
