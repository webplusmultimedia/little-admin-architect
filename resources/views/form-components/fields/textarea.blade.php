@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Textarea; @endphp
@php
    /** @var Textarea $field */
    $id = $field->getId();

@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])
            ->merge([
                   'wire:model' . $field->getWireModifier() => $field->getStatePath(),
                   'id' => $id,
                   'type' => 'hidden',
            ])
        }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()" :id="$field->getWrapperId()"
        {{ $attributes->class('')->merge(['class'=> $field->getColSpan()]) }}
    >
        <x-little-anonyme::form-components.fields.partials.label class="form-label"
                                                                 :id="$id"
                                                                 :is-required="$field->isRequired()"
                                                                 :label="$field->getLabel()"
        />
        <div class="">
            <textarea {{ $attributes->merge([
                'wire:model' . $field->getWireModifier() =>  $field->getStatePath(),
                'id' => $id,
				'rows' => $field->getRows(),
                'placeholder' => $field->getPlaceHolder(),
                'aria-describedby' => $id
            ])}}></textarea>
            <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()"/>
            <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)"/>
        </div>
    </x-dynamic-component>
@endif
