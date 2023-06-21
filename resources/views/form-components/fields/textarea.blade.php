@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Textarea; @endphp
@php
    /** @var Textarea $field */
    $field = $getConfig();
    $id = $field->getId();
    $errorMessage = $getErrorMessage($errors);
    $isWired = $componentIsWired();

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
            {{-- @if($prepend)
                 <x:form::partials.addon :addon="$prepend"/>
             @endif--}}
            <textarea {{ $attributes->merge([
                'wire:model' . $getComponentLivewireModifier() =>  $field->getWireName(),
                'id' => $id,
				'rows' => $field->getRows(),
                'placeholder' => $field->getPlaceHolder(),
                'aria-describedby' => $id
            ])}}></textarea>
            {{--
              @if($append)
                  <x:form::partials.addon :addon="$append"/>
              @endif--}}
            <x-dynamic-component :component="$field->getViewComponentForHelperText()" :caption="$field->getHelperText()"/>
            <x-dynamic-component :component="$field->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>
    </x-dynamic-component>
@endif
