@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Textarea; @endphp
@foreach($locales as $locale)
    @php
        /** @var Textarea $config */
        $config = $getConfig();
        $id = $getId($locale) ?: $getDefaultId('textarea', $locale);
        $label = $getLabel($locale);
        $displayFloatingLabel = $shouldDisplayFloatingLabel();
        $placeholder = $getPlaceholder($label, $locale);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage = $getErrorMessage($errors, $locale);
        $validationClass = $getValidationClass($errors, $locale);
        $isWired = $componentIsWired();
    @endphp
    <div @class(['col-span-full mb-3' => $marginBottom])>
        @if(($prepend || $append) && ! $displayFloatingLabel)
            <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$label"/>
            <div class="input-group">
                @endif
                @if(! $prepend && ! $append && ! $displayFloatingLabel)
                    <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$label"/>
                @endif
                {{-- @if($prepend && ! $displayFloatingLabel)
                     <x:form::partials.addon :addon="$prepend"/>
                 @endif--}}
                <textarea {{ $attributes->merge([
                'wire:model' . $getComponentLivewireModifier() => $isWired && ! $hasComponentNativeLivewireModelBinding() ? ($locale ? $config->getWireName() . '.' . $locale : $config->getWireName()) : NULL,
                'id' => $id,
                'class' => 'form-control' . ($validationClass ? ' ' . $validationClass : NULL),
                'name' => $locale ? $name . '[' . $locale . ']' : $name,
				'rows' => $config->getRows(),
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'aria-describedby' => $caption ? $id . '-caption' : NULL,
            ])}}>{{ $isWired ? NULL : $value }}</textarea>
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
