@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
/** @var Select $field */
    $id = $field->getId();

@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])
            ->merge([
                'wire:model' . $field->getWireModifier() => $field->getStatePath(),
                'id' => $id, 'type' => 'hidden',
            ])
        }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()"
                         :id="$field->getWrapperId()"
                         x-data="{}"
        {{ $attributes->class($field->getColSpan()) }}
    >

        @if($field->isSearchable())
            <x-little-anonyme::form-components.fields.partials.select.searchSelect :field="$field"/>
        @else
            <x-little-anonyme::form-components.fields.partials.label class="form-label"
                                                                     :id="$id"
                                                                     :is-required="$field->isRequired()"
            >
                {{ $field->getLabel() }}
            </x-little-anonyme::form-components.fields.partials.label>
            <select {{ $attributes->merge([
                'wire:model' . $field->getWireModifier() => $field->getStatePath(),
                'id' => $id,
                'placeholder' => $field->getPlaceHolder(),
                 'class' => 'py-2 px-2',
                'aria-describedby' => $id
            ])}}
                    @if($field->isRequired()) required @endif
                    @if($field->isDisabled()) disabled @endif

            >
                <option value="">----- {{ $field->getPlaceHolder()??__('little-admin-architect::form.select.option.empty-placeholder') }} -----</option>
                @foreach($field->getOptions() as $key => $option)
                    <option value="{{ $key }}">{{ $option }}</option>
                @endforeach
            </select>
        @endif
        <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()" class="mb-1"/>
        <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)" class="mb-1"/>
    </x-dynamic-component>
@endif
