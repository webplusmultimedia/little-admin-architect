@foreach($locales as $locale)
    @php
        $id = $getId($locale) ?: $getDefaultId($type, $locale);
        $label = $getLabel($locale);
        $displayFloatingLabel = $shouldDisplayFloatingLabel();
        $placeholder = $getPlaceholder($label, $locale);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage =  $getErrorMessage($errors, $locale);
        $validationClass = $getValidationClass($errors, $locale);
        $isWired = $componentIsWired();
		$_name = ($locale ? 'data.'.$name . '.' . $locale : 'data.'.$name);
    @endphp
    <div
        @class(['hidden' => $type === 'hidden', 'form-floating' => $displayFloatingLabel, 'mb-3' => $marginBottom])
        x-data="{ errors : null/*$wire.__instance.errors*/}"
    >
        @if(($prepend || $append) && ! $displayFloatingLabel)
            <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
            <div class="input-group">
                @endif
                @if(! $prepend && ! $append && ! $displayFloatingLabel)
                    <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
                @endif
                @if($prepend && ! $displayFloatingLabel)
                    <x:form::partials.addon :addon="$prepend"/>
                @endif
                <input {{ $attributes->except('wire')->merge([
                'wire:model' . $getComponentLivewireModifier() => $isWired && ! $hasComponentNativeLivewireModelBinding() ? ($locale ? 'data.'.$name . '.' . $locale : 'data.'.$name) : NULL,
                'id' => $id,
                'class' => 'form-control' . ($validationClass ? ' ' . $validationClass : NULL),
                'type' => $type,
                'name' => $locale ? $name . '[' . $locale . ']' : $name,
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'value' => $isWired ? NULL : ($value ?? ''),
                'aria-describedby' => $caption ? $id . '-caption' : NULL,
            ]) }}/>
                @if(! $prepend && ! $append && $displayFloatingLabel)
                    <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
                @endif
                @if($append && ! $displayFloatingLabel)
                    <x:form::partials.addon :addon="$append"/>
                @endif
                <x:form::partials.caption :inputId="$id" :caption="$caption"/>
                <x:form::partials.error-message :message="$errorMessage"/>
                @if(($prepend || $append) && ! $displayFloatingLabel)
            </div>
        @endif
    </div>
@endforeach
