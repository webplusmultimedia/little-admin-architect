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
<x-dynamic-component :component="$config->getWrapperView()" :id="str($config->getName())->pipe('md5')->append('-',$id)"
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
