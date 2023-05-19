@php

    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Radio;$config = $getConfig();
/** @var Radio $config */
    $id = $config->getId();

    $errorMessage =  $getErrorMessage($errors);

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
                         :id="$config->getWrapperId()"
        {{ $attributes->class('relative little-admin-fildset')->merge(['class'=> $config->getColSpan()]) }}
    >
        <div {{ $attributes->class('grid px-4')->merge(['class'=> $config->getColumns()]) }} >
            <div class="col-span-full inline-flex item-center  py-3 text-sm font-bold uppercase text-slate-600">
                <span class="bg-white z-[1] px-2">{{ $config->getLabel() }}</span>
                @if($config->isRequired())
                    <span class="whitespace-nowrap bg-white z-[1] pr-2">
                <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
            </span>
                @endif
            </div>
            @foreach($config->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <x-dynamic-component :component="$config->getViewComponentForLabel()"
                                     :id="$idGroup"
                                     class=" items-center gap-2" :label="$option"
                                     :showRequired="false"
                >
                    <input id="{{$idGroup}}"
                           aria-describedby="{{$idGroup}}"
                           value="{{$key}}"
                           type="radio"
                           name="{{ $id }}"
                           wire:model{{ $config->getWireModifier() }}="{{ $config->getWireName() }}"
                    >
                </x-dynamic-component>
            @endforeach
            <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()" class="mb-1"/>
            <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage" class="mb-1"/>
        </div>
    </x-dynamic-component>
@endif

