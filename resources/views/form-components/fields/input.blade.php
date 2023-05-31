@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
    /** @var Input $field */
        $field = $getConfig();
        $id = $field->getId();
        $prepend = $getPrepend();
        $append = $getAppend();
        $errorMessage =  $getErrorMessage($errors);

@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
            {{ $attributes->except(['field'])->merge([
                       'wire:model' . $field->getWireModifier() => $field->getWireName(),
                       'id' => $id,
                       'type' => 'hidden',
                       ])
                       }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()"
                         :id="$field->getWrapperId()"
                         {{ $attributes->class('')->merge(['class'=> $field->getColSpan()]) }}
                         @class([  'hidden' => $field->getType() === 'hidden'])
                         x-data="{ errors : $wire.__instance.errors}"
    >
        <x-dynamic-component :component="$field->getViewComponentForLabel()" :id="$id" class="form-label" :label="$field->getLabel()"
                             :showRequired="$field->isRequired()"/>

        {{--  @if($prepend)
              <x:form::partials.addon :addon="$prepend"/>
          @endif--}}
        <input {{ $attributes->except(['field'])->merge([
                'wire:model' . $field->getWireModifier() => $field->getWireName(),
                'id' => $id,
                'class' => 'py-2 px-2',
                'type' => $field->getType(),
                'placeholder' => $field->getPlaceHolder(),
                'aria-describedby' => $caption ? $id . '-caption' : NULL,
                'minlength' => $field->getMinLength() ,
                'maxlength' => $field->getMaxLength() ,
                'step' => $field->getStep() ,
                'inputmode' => $field->getInputMode() ,
                'min' => $field->getMinValue() ,
                'max' => $field->getMaxValue() ,
            ]) }}
               @if($field->isRequired()) required @endif
               @if($field->isDisabled()) disabled @endif
        />
        {{--
          @if($append)
              <x:form::partials.addon :addon="$append"/>
          @endif--}}

        <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()"/>
        <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>


    </x-dynamic-component>
@endif
