@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Input;use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
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
        <div class="flex items-center justify-between">
            <x-little-anonyme::form-components.fields.partials.label class="form-label"
                                                                     :id="$id"
                                                                     :is-required="$field->isRequired()"
            >
                {{ $field->getLabel() }} @if($field->hasTranslated())
                    ({{ Form::getSelectedTranslateLangue() }})
                @endif
            </x-little-anonyme::form-components.fields.partials.label>
            @if($field->hasTranslated())
                <x-little-anonyme::form-components.fields.partials.translation-langues/>
            @endif
        </div>
        @if($field->hasTranslated())
            @foreach(Form::getNotSelectedLanguages() as $langage)
                <input type="hidden" wire:model="{{ $field->getStatePathForTranslateName($langage) }}">
            @endforeach
        @endif

        <input {{ $attributes->except(['field'])->merge([
                'wire:model' . $field->getWireModifier() => $field->hasTranslated()?$field->getStatePathForTranslateName(Form::getSelectedTranslateLangue()):$field->getStatePath(),
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

        />
        <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()"/>
        <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)"/>
    </x-dynamic-component>
@endif
