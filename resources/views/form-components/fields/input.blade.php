@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;
    /** @var Input $field */
        $id = $field->getId();
@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
            {{ $attributes->except(['field'])->merge([
                       'wire:model' . $field->getWireModifier() => $field->getStatePath(),
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
        <x-dynamic-component :component="$field->getViewComponentForLabel()" :id="$id" class="form-label" label=""
                             :showRequired="$field->isRequired()">
            {{ $field->getLabel() }}
        </x-dynamic-component>


        <input {{ $attributes->except(['field'])->merge([
                'wire:model' . $field->getWireModifier() => $field->getStatePath(),
                'id' => $id,
                'class' => 'py-2 px-2',
                'type' => $field->getType(),
                'placeholder' => $field->getPlaceHolder(),
               // 'aria-describedby' =>  $id . '-caption',
                'minlength' => $field->getMinLength() ,
                'maxlength' => $field->getMaxLength() ,
                'step' => $field->getStep() ,
                'inputmode' => $field->getInputMode() ,
                'min' => $field->getMinValue() ,
                'max' => $field->getMaxValue() ,
            ]) }}
               @if($field->isRequired()) required @endif
               @if($field->isDisabled()) disabled @endif
            x-data="{}"
        />
        <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()"/>
        <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)"/>
    </x-dynamic-component>
@endif
