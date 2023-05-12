@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input; @endphp

@php
    /** @var Input $config */
        $config = $getConfig();
        $id = $config->getId();
        $prepend = $getPrepend();
        $append = $getAppend();
        $errorMessage =  $getErrorMessage($errors);

@endphp
<x-dynamic-component :component="$config->getWrapperView()"
                     :id="str($config->getName())->pipe('md5')->append('-',$id)"
                     {{ $attributes->class('')->merge(['class'=> $config->getColSpan()]) }}
                     @class([  'hidden' => $config->getType() === 'hidden'])
                     x-data="{ errors : $wire.__instance.errors}"
>
    <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$config->getLabel()"
                         :showRequired="$isShowSignRequiredOnLabel()"/>
    @if(($prepend || $append))
        <div class="input-group">
            @endif

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
            @if(($prepend || $append))
        </div>
    @endif
</x-dynamic-component>
