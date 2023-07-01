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
            @if($errorMessage)
                <div class="wf-full">
                    <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>
                </div>
            @endif
        </div>
    </x-dynamic-component>
@endif
