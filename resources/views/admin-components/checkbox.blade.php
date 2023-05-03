@php
    $groupMode = (bool) array_filter($group);
    if($groupMode && $caption) {
        $captionId = $getId() ?: $getDefaultId($toggleSwitch ? 'toggle-switch' : 'checkbox');
    }
    $errorMessage = $getErrorMessage($errors);
    $validationClass = $getValidationClass($errors);
    $isWired = $componentIsWired();
@endphp
@if($groupMode)
    <div @class(['mb-3' => $marginBottom])>
        <div>
            <x:form::partials.label class="form-label" :label="$getLabel()"/>
        </div>
@endif
@foreach($group as $groupValue => $groupLabel)
    @php
        $id = $getId(suffix: $groupMode ? $groupValue : null)
            ?: $getDefaultId(prefix: $toggleSwitch ? 'toggle-switch' : 'checkbox', suffix: $groupMode ? $groupValue : null);
        $label = $groupMode ? $groupLabel : $getLabel();
        $checked = $groupMode ? $getGroupModeCheckedStatus($groupValue) : $getSingleModeCheckedStatus();
    @endphp
    <div @class(['form-check', 'form-switch' => $toggleSwitch, 'form-check-inline' => $inline, 'mb-3' => $groupMode ? null : $marginBottom])>
        <div class="flex bg-gray-100 rounded-full w-16 h-5 duration-200"
             x-data="{ open : false }" x-on:click="open = !open"
             x-bind:class="{ 'justify-start': !open,'justify-end': open , 'bg-gray-300': !open,'bg-success-400': open}"
             role="button"
        >
            <div class="w-5 h-5 rounded-full border  duration-200 bg-white"

            ></div>
        </div>
        <input {{ $attributes->merge([
            'wire:model' . $getComponentLivewireModifier() => $isWired && ! $hasComponentNativeLivewireModelBinding() ? $name : null,
            'id' => $id,
            'class' => 'form-check-input' . ($validationClass ? ' ' . $validationClass : null),
            'name' => $name . ($groupMode ? '[]' : null),
            'value' => $groupMode ? $groupValue : null,
            'checked' => $isWired ? null : $checked,
            'aria-describedby' => $caption ? ($groupMode && $caption ? $captionId : $id) . '-caption' : null,
        ]) }} type="checkbox">

        <x:form::partials.label :id="$id" class="form-check-label" :label="$label"/>
        @if(! $groupMode)
            <x:form::partials.caption :inputId="$id" :caption="$caption"/>
            <x:form::partials.error-message :message="$errorMessage"/>
        @endif
    </div>
@endforeach
@if($groupMode)
    <x:form::partials.caption :inputId="$groupMode && $caption ? $captionId : $id" :caption="$caption"/>
    <x:form::partials.error-message class="d-block" :message="$errorMessage"/>
@endif
@if($groupMode)
    </div>
@endif
