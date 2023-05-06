@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\CheckBox;
    /** @var CheckBox $config */
    $config = $getConfig();
        $groupMode = (bool) array_filter($group);
        if($groupMode && $caption) {
            $captionId = $getId() ?: $getDefaultId($toggleSwitch ? 'toggle-switch' : 'checkbox');
        }
        $errorMessage = $getErrorMessage($errors);
        $validationClass = $getValidationClass($errors);
        $isWired = $componentIsWired();
@endphp

@foreach($group as $groupValue => $groupLabel)
    @php
        $id = $getId(suffix: $groupMode ? $groupValue : NULL)
            ?: $getDefaultId(prefix: $toggleSwitch ? 'toggle-switch' : 'checkbox', suffix: $groupMode ? $groupValue : NULL);
        $label = $groupMode ? $groupLabel : $getLabel();
        $checked = $groupMode ? $getGroupModeCheckedStatus($groupValue) : $getSingleModeCheckedStatus();
    @endphp
    <x-dynamic-component :component="$config->getWrapperView()" class="mb-3 pl-3" :id="$config->getWrapperId()">
        <label @class(['inline-flex space-x-2   items-center'])>
            {{--<div class="flex bg-gray-100 rounded-full w-16 h-5 duration-200"
                 x-data="{ open : false }" x-on:click="open = !open"
                 x-bind:class="{ 'justify-start': !open,'justify-end': open , 'bg-gray-300': !open,'bg-success-400': open}"
                 role="button"
            >
                <div class="w-5 h-5 rounded-full border  duration-200 bg-white"

                ></div>
            </div>--}}
            <input {{ $attributes->merge([
            'wire:model' . $config->getWireModifier() => ($config->getWireName()),
            'id' => $id,
            'class' => 'form-check-input' . ($validationClass ? ' ' . $validationClass : NULL),
            'aria-describedby' => $id,
        ]) }} type="checkbox">
            <span class="">
                {{ $config->getLabel() }}
            </span>
        </label>
        <div class="wf-full">
            <x-dynamic-component :component="$config->getViewComponentForErrorMessage()" :message="$errorMessage"/>
        </div>
    </x-dynamic-component>

@endforeach

