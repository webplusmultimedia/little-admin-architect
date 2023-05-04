@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Textarea; @endphp
@foreach($locales as $locale)
    @php
        /** @var Textarea $config */
        $config = $getConfig();
        $id = $getId($locale) ?: $getDefaultId('textarea', $locale);
        $label = $getLabel($locale);
        $placeholder = $getPlaceholder($label, $locale);
        $value = $getValue($locale);
        $prepend = $getPrepend($locale);
        $append = $getAppend($locale);
        $errorMessage = $getErrorMessage($errors, $locale);
        $validationClass = $getValidationClass($errors, $locale);
        $isWired = $componentIsWired();

    @endphp
    <div @class([$config->getColSpan(),'mb-3'])>
        <x-dynamic-component
            :component="$config->getViewComponentForLabel()"
            :id="$id" class="form-label"
            :label="$config->getLabel()"
            :showRequired="$isShowSignRequiredOnLabel()"
        />
        @if(($prepend || $append))
            <div class="input-group">
                @endif

                {{-- @if($prepend)
                     <x:form::partials.addon :addon="$prepend"/>
                 @endif--}}
                <textarea {{ $attributes->merge([
                'wire:model' . $getComponentLivewireModifier() => ($locale ? $config->getWireName() . '.' . $locale : $config->getWireName()),
                'id' => $id,
                'class' => 'form-control' . ($validationClass ? ' ' . $validationClass : NULL),
				'rows' => $config->getRows(),
                'placeholder' => $placeholder,
                'data-locale' => $locale,
                'aria-describedby' => $caption ? $id . '-caption' : NULL,
            ])}}></textarea>
                {{--
                  @if($append)
                      <x:form::partials.addon :addon="$append"/>
                  @endif--}}
                <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()"/>
                <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>
                @if(($prepend || $append))
            </div>
        @endif


    </div>
@endforeach
