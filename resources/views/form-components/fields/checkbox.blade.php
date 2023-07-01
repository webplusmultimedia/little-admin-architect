@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBox;
    /** @var CheckBox $field */
    $field = $getConfig();
    $id = $field->getId();
    $errorMessage = $field->getErrorMessage($errors);
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
                         {{ $attributes->class('flex items-center')->merge(['class'=> $field->getColSpan()]) }}
                         :id="$field->getWrapperId()"
    >
        <div>
            <x-dynamic-component :component="$field->getViewComponentForLabel()"
                                 :id="$id"
                                 @class(['disabled__field' => $field->isDisabled(),"inline-flex items-center gap-2"])
                                 :label="$field->getLabel()"
                                 :showRequired="$field->isRequired()"
            >
                @if($field->getType() === 'switch')
                    <x-little-anonyme::form-components.fields.partials.toggle-switch
                            {{ $attributes->merge(['wire:model' . $field->getWireModifier() => ($field->getStatePath())]) }}
                            :id="$id"

                    />
                @else
                    <input {{ $attributes->merge([
                            'wire:model' . $field->getWireModifier() => ($field->getStatePath()),
                            'id' => $id,
                            'aria-describedby' => $id
                        ]) }}
                           type="checkbox"
                    >
                @endif
            </x-dynamic-component>

                    <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()"/>
                    <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)"/>

        </div>
    </x-dynamic-component>
@endif
