@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FileUpload;
    /** @var FileUpload $field */
	$field = $getConfig();
	$id = $field->getId();
    $errorMessage = $getErrorMessage($errors);
@endphp
@if($field->isHidden())
    <x-little-anonyme::form-components.fields.partials.hidden-field
        {{ $attributes->except(['field'])
            ->merge([
                   'wire:model' . $field->getWireModifier() => $field->getWireName(),
                   'id' => $id,
                   'type' => 'hidden',
            ])
        }}
    />
@else
    <x-dynamic-component :component="$field->getWrapperView()" :id="$field->getWrapperId()"
        {{ $attributes->class('')->merge(['class'=> $field->getColSpan()]) }}
    >
        <x-dynamic-component
            :component="$field->getViewComponentForLabel()"
            :id="$id" class="form-label"
            :label="$field->getLabel()"
            :showRequired="$field->isRequired()"
        />
        <div class="">
            <div class=""
                x-data="fileUpload({
                    fieldName : @js($field->getWireName()),
                    minSize : @js($field->getMinSize()),
                    maxSize : @js($field->getMaxSize()),
                    maxFiles : @js($field->getMaxFiles()),
                    acceptedFileTypes : @js($field->getAcceptedFileTypes()),
                    multiple : {{  $field->isMultiple()?'true':'false' }},

                    state : $wire.entangle(@js($field->getWireName())){{ $field->getWireModifier() }},

                })"
                 x-on:livewire-upload-start="isUploadingFile = true"
                 x-on:livewire-upload-finish="isUploadingFile = false"
                 x-on:livewire-upload-error="isUploadingFile = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress"
                 x-id="['file-input']"
                 wire:ignore
            >
                <input type="file"  :id="$id('file-input')"
                       x-ref="file_input"
                       class="hidden"
                    {{ $field->isMultiple()?'multiple':'' }}
                    {{ $field->isDisabled()?'disabled':'' }}
                    accept="{{  $field->getAcceptFileTypes() }}"
                >
                <div class="la-dropzone" role="button"
                     x-bind="dropZone"
                     x-ref="dropzone"
                >
                    <x-heroicon-o-arrow-down-tray class="w-5 h-auto"/>
                </div>
            </div>

            <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()"/>
            <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>

    </x-dynamic-component>

@endif
