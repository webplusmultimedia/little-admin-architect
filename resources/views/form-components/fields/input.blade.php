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
                         @class([  'hidden' => $field->getType()->value === 'hidden'])
                         x-data="{ errors : $wire.__instance.errors}"
    >
        <x-little-anonyme::form-components.fields.partials.label class="form-label"
                                                                 :id="$id"
                                                                 :is-required="$field->isRequired()"
        >
            {{ $field->getLabel() }}
        </x-little-anonyme::form-components.fields.partials.label>

        <input {{ $attributes->except(['field'])->merge([
                'wire:model' . $field->getWireModifier() => $field->getStatePath(),
                'id' => $id,

                'type' => $field->getType()->value,
                'placeholder' => $field->getPlaceHolder(),
                'aria-describedby' =>  $id,
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
