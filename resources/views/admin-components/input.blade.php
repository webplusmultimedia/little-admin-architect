@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input; @endphp
@foreach($locales as $locale)
    @php
        /** @var Input $config */
            $config = $getConfig();
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
    @endphp
    <div
        @class([ 'mb-3 col-span-1','hidden' => $config->getType() === 'hidden'])
        x-data="{ errors : $wire.__instance.errors}"
    >

        @if(($prepend || $append) && ! $displayFloatingLabel)
            <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$label"/>
            <div class="input-group">
                @endif
                @if(! $prepend && ! $append && ! $displayFloatingLabel)
                    <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$label"/>
                @endif
                {{--  @if($prepend && ! $displayFloatingLabel)
                      <x:form::partials.addon :addon="$prepend"/>
                  @endif--}}
                <input {{ $attributes->except(['wire','field'])->merge([
                'wire:model' . $config->getWireModifier() => $isWired && ! $hasComponentNativeLivewireModelBinding() ? ($locale ? $config->getWireName() . '.' . $locale : $config->getWireName()) : NULL,
                'id' => $id,
                'class' => 'form-control' . ($validationClass ? ' ' . $validationClass : NULL),
                'type' => $type,
                'name' => $locale ? $name . '[' . $locale . ']' : $name,
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'value' => $isWired ? NULL : ($value ?? ''),
                'aria-describedby' => $caption ? $id . '-caption' : NULL,
                'minlength' => $config->getMinLength() ,
                'maxlength' => $config->getMaxLength() ,
                'step' => $config->getStep() ,
                'inputmode' => $config->getInputMode() ,
                'min' => $config->getMinValue() ,
                'max' => $config->getMaxValue() ,
            ]) }}
                       @if($config->isRequired()) required @endif
                       @if($config->isDisabled()) disabled @endif
                />
                {{--  @if(! $prepend && ! $append && $displayFloatingLabel)
                      <x:form::partials.label :id="$id" class="form-label" :label="$label"/>
                  @endif
                  @if($append && ! $displayFloatingLabel)
                      <x:form::partials.addon :addon="$append"/>
                  @endif--}}

                <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()"/>
                <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>
                @if(($prepend || $append) && ! $displayFloatingLabel)
            </div>
        @endif
    </div>
@endforeach
