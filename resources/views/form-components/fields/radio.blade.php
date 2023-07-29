@php

    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Radio;
    /** @var Radio $field */
    $id = $field->getId();

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
                         :id="$field->getWrapperId()"
        @class(['disabled__field' => $field->isDisabled()])
            {{ $attributes->class('relative little-admin-fildset')->merge(['class'=> $field->getColSpan()]) }}
    >
        <div {{ $attributes->class('grid px-4')->merge(['class'=> $field->getColumns()]) }} >
            <div class="col-span-full inline-flex item-center  py-3 text-sm font-bold uppercase text-slate-600">
                <span class="bg-white dark:bg-gray-700 z-[1] dark:text-white/90 px-2">{{ $field->getLabel() }}</span>
                @if($field->isRequired())
                    <span class="whitespace-nowrap bg-white z-[1] pr-2 dark:bg-gray-700 dark:text-white/90">
                <sup class="font-medium text-error-700 dark:text-error-500">*</sup>
            </span>
                @endif
            </div>
            @foreach($field->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <x-little-anonyme::form-components.fields.partials.label class="inline-flex items-center gap-2" :label="$option"
                                                                         :id="$idGroup"
                                                                         :is-required="false"
                >
                    <input id="{{$idGroup}}"
                           aria-describedby="{{$idGroup}}"
                           value="{{$key}}"
                           type="radio"
                           name="{{ $id }}"
                           wire:model{{ $field->getWireModifier() }}="{{ $field->getStatePath() }}"
                    >
                </x-little-anonyme::form-components.fields.partials.label>
            @endforeach
            <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()" class="mb-1"/>
            <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)" class="mb-1"/>
        </div>
    </x-dynamic-component>
@endif

