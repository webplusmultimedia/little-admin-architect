 <div @class(["mb-1" => $wrappedWithMargin])>
        <label {{ $attributes->merge(['for' => $id,'class' => '']) }}>
            {{ $slot }}
            {{ $label }}
            @if($showRequired)
                <span class="whitespace-nowrap">
                    <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
                 </span>
            @endif
        </label>
 </div>
