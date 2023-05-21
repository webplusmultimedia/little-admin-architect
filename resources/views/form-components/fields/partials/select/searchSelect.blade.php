@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select; @endphp
@props([
	/** @var Select $field */
	'field'
])
<div class="relative flex space-y-1 px-2 py-2"
    x-data="SelectFormComponent(
    {
            getOptionLabelUsing: async () => {
                return await $wire.getSelectOptionLabelUsing('{{$field->getWireName()}}')
            },
            getOptionLabelsUsing: async () => {
                return await $wire.getSelectOptionLabelsUsing('{{$field->getWireName()}}')
            },
            getOptionsUsing: async () => {
                return await $wire.getSelectOptionsUsing('{{$field->getWireName()}}')
            },
            getSearchResultsUsing: async (search) => {
                return await $wire.getSelectSearchResultsUsing('{{$field->getWireName()}}', search)
            },
            labelDefault : '{{ $field->getLabelDefault()  }}',
            state: $wire.entangle({{$field->getWireName()}}).defer
        }
    )"
     wire:ignore
    {{ $attributes }}
>
    {{ $slot }}
<div class=""></div>

</div>
