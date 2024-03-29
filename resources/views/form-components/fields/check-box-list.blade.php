@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\CheckBoxList;
/** @var CheckBoxList $field */
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
            {{ $attributes->merge(['class'=> $field->getColSpan()]) }}
    >
        <div {{ $attributes->class('grid auto-rows-min')->merge(['class'=> $field->getColumns()]) }}>
            <div class="col-span-full  py-3 text-sm font-bold uppercase text-slate-600  dark:text-white/90 ">
                {{ $field->getLabel() }}
                @if($field->isRequired())
                    <span class="whitespace-nowrap">
                    <sup class="font-medium text-error-700 dark:text-error-400">*</sup>
            </span>
                @endif
            </div>
            @foreach($field->getOptions() as $key => $option)
                @php($idGroup = str($key)->slug()->append($id))
                <x-little-anonyme::form-components.fields.partials.label  :id="$idGroup"
                                                                         :is-required="false"
                                                                         class="form-label gap-2"
                                                                          :label="$option"
                >
                    <input id="{{$idGroup}}"
                           aria-describedby="{{$idGroup}}"
                           value="{{$key}}"
                           type="checkbox"
                           wire:model{{ $field->getWireModifier() }}="{{ $field->getStatePath() }}"
                    >
                </x-little-anonyme::form-components.fields.partials.label>
            @endforeach
            <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()"/>
            <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)"/>
        </div>
    </x-dynamic-component>
@endif

