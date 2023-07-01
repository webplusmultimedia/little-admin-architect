@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select;
/** @var Select $field */
    $field = $getConfig();
    $id = $field->getId();

@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
            {{ $attributes->except(['field'])->merge(['wire:model' . $field->getWireModifier() => $field->getStatePath(),'id' => $id, 'type' => 'hidden',]) }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()"
                         :id="$field->getWrapperId()"
            {{ $attributes->class('')->merge(['class'=> $field->getColSpan()]) }}
    >
        <x-dynamic-component :component="$field->getViewComponentForLabel()" :id="$id" class="form-label" :label="$field->getLabel()"
                             :showRequired="$field->isRequired()"/>

        @if($field->isSearchable())
            <x-little-anonyme::form-components.fields.partials.select.searchSelect :field="$field"/>

        @else
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
        <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()" class="mb-1"/>
        <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$field->getErrorMessage($errors)" class="mb-1"/>
    </x-dynamic-component>
@endif

