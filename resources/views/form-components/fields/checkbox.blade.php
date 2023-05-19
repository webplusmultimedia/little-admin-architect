@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\CheckBox;
    /** @var CheckBox $config */
    $config = $getConfig();
    $id = $config->getId();
    $errorMessage = $getErrorMessage($errors);
    $validationClass = $getValidationClass($errors);
@endphp
@if($config->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])->merge([
                   'wire:model' . $config->getWireModifier() => $config->getWireName(),
                   'id' => $id,
                   'type' => 'hidden',
                   ])
                   }}
    />
@else
    <x-dynamic-component :component="$config->getWrapperView()"

                         {{ $attributes->class('flex items-center')->merge(['class'=> $config->getColSpan()]) }}
                         :id="$config->getWrapperId()"
    >
        <div>
            <x-dynamic-component :component="$config->getViewComponentForLabel()"
                                 :id="$id"
                                 class=" items-center gap-2" :label="$config->getLabel()"
                                 :showRequired="$isShowSignRequiredOnLabel()"
            >
                @if($config->getType() === 'switch')
                    <x-little-anonyme::form-components.fields.partials.toggle-switch
                        {{ $attributes->merge(['wire:model' . $config->getWireModifier() => ($config->getWireName())]) }}
                        :id="$id"

                    />
                @else
                    <input {{ $attributes->merge([
                            'wire:model' . $config->getWireModifier() => ($config->getWireName()),
                            'id' => $id,
                            'aria-describedby' => $id
                        ]) }}
                           type="checkbox"
                    >
                @endif
            </x-dynamic-component>
            @if($errorMessage)
                <div class="wf-full">
                    <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>
                </div>
            @endif
        </div>
    </x-dynamic-component>
@endif
