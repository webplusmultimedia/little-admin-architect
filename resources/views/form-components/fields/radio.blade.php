@php

    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
    /** @var Radio $field */
    $field = $getConfig();

    $id = $field->getId();

    $errorMessage =  $getErrorMessage($errors);

@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
            {{ $attributes->except(['field'])->merge([
                       'wire:model' . $field->getWireModifier() => $field->getWireName(),
                       'id' => $id,
                       'type' => 'hidden',
                       ])
            }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()"
                         :id="$field->getWrapperId()"
        @class(['disabled__field' => $field->isDisabled()])
            {{ $attributes->class('relative little-admin-fildset')->merge(['class'=> $field->getColSpan()]) }}
    >
        <div {{ $attributes->class('grid px-4')->merge(['class'=> $field->getColumns()]) }} >
            <div class="col-span-full inline-flex item-center  py-3 text-sm font-bold uppercase text-slate-600">
                <span class="bg-white z-[1] px-2">{{ $field->getLabel() }}</span>
                @if($field->isRequired())
                    <span class="whitespace-nowrap bg-white z-[1] pr-2">
                <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
            </span>
                @endif
            </div>
            @foreach($field->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <x-dynamic-component :component="$field->getViewComponentForLabel()"
                                     :id="$idGroup"
                                     class=" items-center gap-2" :label="$option"
                                     :showRequired="false"
                >
                    <input id="{{$idGroup}}"
                           aria-describedby="{{$idGroup}}"
                           value="{{$key}}"
                           type="radio"
                           name="{{ $id }}"
                           wire:model{{ $field->getWireModifier() }}="{{ $field->getWireName() }}"
                    >
                </x-dynamic-component>
            @endforeach
            <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()" class="mb-1"/>
            <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage" class="mb-1"/>
        </div>
    </x-dynamic-component>
@endif

