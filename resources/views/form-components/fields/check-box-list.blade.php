@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\CheckBoxList;
/** @var CheckBoxList $config */
    $config = $getConfig();
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
        {{ $attributes->merge(['class'=> $config->getColSpan()]) }}
    >
        <div {{ $attributes->class('grid auto-rows-min')->merge(['class'=> $config->getColumns()]) }}>
            <div class="col-span-full  py-3 text-sm font-bold uppercase text-slate-600">
                {{ $config->getLabel() }}
                @if($config->isRequired())
                    <span class="whitespace-nowrap">
                    <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
            </span>
                @endif
            </div>
            @foreach($config->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <x-dynamic-component :component="$config->getViewComponentForLabel()"
                                     :id="$idGroup"
                                     class="gap-2" :label="$option"
                                     :showRequired="false"
                >
                    <input id="{{$idGroup}}"
                           aria-describedby="{{$idGroup}}"
                           value="{{$key}}"
                           type="checkbox"
                           wire:model{{ $config->getWireModifier() }}="{{ $config->getWireName() }}"
                    >
                </x-dynamic-component>
            @endforeach
            <x-dynamic-component :component="$config->getViewComponentForHelperText()" :caption="$config->getHelperText()"/>
            <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>
    </x-dynamic-component>
@endif

