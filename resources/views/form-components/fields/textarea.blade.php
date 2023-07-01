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
        <x-dynamic-component
            :component="$field->getViewComponentForLabel()"
            :id="$id" class="form-label"
            :label="$field->getLabel()"
            :showRequired="$field->isRequired()"
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
