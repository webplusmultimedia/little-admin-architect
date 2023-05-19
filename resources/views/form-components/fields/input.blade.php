@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input;
    /** @var Input $config */
        $config = $getConfig();
        $id = $config->getId();
        $prepend = $getPrepend();
        $append = $getAppend();
        $errorMessage =  $getErrorMessage($errors);

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
<x-dynamic-component :component="$config->getWrapperView()"
                     :id="$config->getWrapperId()"
                     {{ $attributes->class('')->merge(['class'=> $config->getColSpan()]) }}
                     @class([  'hidden' => $config->getType() === 'hidden'])
                     x-data="{ errors : $wire.__instance.errors}"
>
        <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$config->getLabel()"
                             :showRequired="$isShowSignRequiredOnLabel()"/>

        {{--  @if($prepend)
              <x:form::partials.addon :addon="$prepend"/>
          @endif--}}
        <input {{ $attributes->except(['field'])->merge([
                'wire:model' . $config->getWireModifier() => $config->getWireName(),
                'id' => $id,
                'class' => 'py-2 px-2',
                'type' => $type,
                'placeholder' => $config->getPlaceHolder(),
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
        {{--
          @if($append)
              <x:form::partials.addon :addon="$append"/>
          @endif--}}

        <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()"/>
        <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>



</x-dynamic-component>
@endif
