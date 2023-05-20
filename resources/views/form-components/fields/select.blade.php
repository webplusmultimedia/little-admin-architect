@php

    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select;
/** @var Select $config */
    $config = $getConfig();
    $id = $config->getId();
    $errorMessage =  $getErrorMessage($errors);

@endphp
@if($config->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])->merge(['wire:model' . $config->getWireModifier() => $config->getWireName(),'id' => $id, 'type' => 'hidden',]) }}
    />
@else
    <x-dynamic-component :component="$config->getWrapperView()"
                         :id="$config->getWrapperId()"
        {{ $attributes->class('')->merge(['class'=> $config->getColSpan()]) }}
    >
        <x-dynamic-component :component="$config->getViewComponentForLabel()" :id="$id" class="form-label" :label="$config->getLabel()"
                             :showRequired="$isShowSignRequiredOnLabel()"/>

        <select  {{ $attributes->merge([
                'wire:model' . $config->getWireModifier() => $config->getWireName(),
                'id' => $id,
                'placeholder' => $config->getPlaceHolder(),
                 'class' => 'py-2 px-2',
                'aria-describedby' => $id
            ])}}
                 @if($config->isRequired()) required @endif
                 @if($config->isDisabled()) disabled @endif
        >
            @foreach($config->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <option value="{{ $key }}">{{ $option }}</option>
            @endforeach
        </select>

            <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()" class="mb-1"/>
            <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage" class="mb-1"/>
    </x-dynamic-component>
@endif

