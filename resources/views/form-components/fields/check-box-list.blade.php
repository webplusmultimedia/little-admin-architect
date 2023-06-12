@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBoxList;
/** @var CheckBoxList $field */
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
            {{ $attributes->merge(['class'=> $field->getColSpan()]) }}
    >
        <div {{ $attributes->class('grid auto-rows-min')->merge(['class'=> $field->getColumns()]) }}>
            <div class="col-span-full  py-3 text-sm font-bold uppercase text-slate-600">
                {{ $field->getLabel() }}
                @if($field->isRequired())
                    <span class="whitespace-nowrap">
                    <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
            </span>
                @endif
            </div>
            @foreach($field->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <x-dynamic-component :component="$field->getViewComponentForLabel()"
                                     :id="$idGroup"
                                     class="gap-2" :label="$option"
                                     :showRequired="false"
                >
                    <input id="{{$idGroup}}"
                           aria-describedby="{{$idGroup}}"
                           value="{{$key}}"
                           type="checkbox"
                           wire:model{{ $field->getWireModifier() }}="{{ $field->getWireName() }}"
                    >
                </x-dynamic-component>
            @endforeach
            <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()"/>
            <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>
    </x-dynamic-component>
@endif

