@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FileUpload;
    /** @var FileUpload $field */
	$id = $field->getId();
@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])
            ->merge([
                   'wire:model' . $field->getWireModifier() => $field->getStatePath(),
                   'id' => $id,
                   'type' => 'hidden',
            ])
        }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()" :id="$field->getWrapperId()"
        {{ $attributes->class('')->merge(['class'=> $field->getColSpan()]) }}
    >
        <x-little-anonyme::form-components.fields.partials.label class="form-label"
                                                                 :id="$id"
                                                                 :is-required="$field->isRequired()"
        >
            {{ $field->getLabel() }}
        </x-little-anonyme::form-components.fields.partials.label>

        <div class="la-file-upload">
            <div class=""
                x-data="fileUpload({
                    fieldName : @js($field->getStatePath()),
                    minSize : @js($field->getMinSize()),
                    maxSize : @js($field->getMaxSize()),
                    maxFiles : @js($field->getMaxFiles()),
                    acceptedFileTypes : @js($field->getAcceptedFileTypes()),
                    multiple : {{  $field->isMultiple()?'true':'false' }},
                    state : $wire.entangle(@js($field->getStatePath())){{ $field->getWireModifier() }},

                })"
                 {{--x-on:livewire-upload-start="Alpine.store('laDatas').startUploadFile = true"
                 x-on:livewire-upload-finish="$store.laDatas.startUploadFile = false"
                 x-on:livewire-upload-error="$store.laDatas.startUploadFile = false"--}}
                 x-on:livewire-upload-progress="progress = $event.detail.progress"
                 x-id="['file-input']"
                 wire:ignore
            >
                <input type="file"  :id="$id('file-input')"
                       x-bind="laFileInput"
                       x-ref="laFileInput"
                       class="hidden"
                    {{ $field->isMultiple()?'multiple':'' }}
                    {{ $field->isDisabled()?'disabled':'' }}
                    accept="{{  $field->getAcceptFileTypes() }}"
                >
                <div class="la-dropzone" role="button"
                     x-bind="dropZone"
                     x-ref="dropzone"
                >
                    <span class="inline-flex gap-3" x-ref="ladroptitle">
                       <x-heroicon-o-arrow-down-tray class="w-5 h-auto"/> <span>Drag & Drop ou cliquer ICI</span>
                    </span>

                </div>
                <div class="flex px-3" x-show="startUpload">
                    <span class="text-primary-600 text-lg" x-text="progress"></span>
                </div>
                <div class="la-file-upload-gallery-wrapper" x-ref="galleryImages">

                </div>
            </div>

            <x-little-anonyme::form-components.fields.partials.helper-text :text="$field->getHelperText()"/>
            <x-little-anonyme::form-components.fields.partials.error-message :message="$field->getErrorMessage($errors)"/>
        </div>

    </x-dynamic-component>

@endif
