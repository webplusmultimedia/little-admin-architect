@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Textarea; @endphp
@php
    /** @var Textarea $config */
    $config = $getConfig();
    $id = $config->getId();
  /*  $prepend = $getPrepend($locale);
    $append = $getAppend($locale);*/
    $errorMessage = $getErrorMessage($errors);
    $validationClass = $getValidationClass($errors);
    $isWired = $componentIsWired();

@endphp
@if($config->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])->merge([
                   'wire:model' . $config->getWireModifier() => $config->getWireName(),
                   'id' => $id,
                   'type' => 'hidden',
                   ])
                   }}
    />
@else
    <x-dynamic-component :component="$config->getWrapperView()" :id="$config->getWrapperId()"
        {{ $attributes->class('')->merge(['class'=> $config->getColSpan()]) }}
    >
        <x-dynamic-component
            :component="$config->getViewComponentForLabel()"
            :id="$id" class="form-label"
            :label="$config->getLabel()"
            :showRequired="$isShowSignRequiredOnLabel()"
        />
        <div class="">
            {{-- @if($prepend)
                 <x:form::partials.addon :addon="$prepend"/>
             @endif--}}
            <textarea {{ $attributes->merge([
                'wire:model' . $getComponentLivewireModifier() =>  $config->getWireName(),
                'id' => $id,
				'rows' => $config->getRows(),
                'placeholder' => $config->getPlaceHolder(),
                'aria-describedby' => $id
            ])}}></textarea>
            {{--
              @if($append)
                  <x:form::partials.addon :addon="$append"/>
              @endif--}}
            <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()"/>
            <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>
    </x-dynamic-component>
@endif
