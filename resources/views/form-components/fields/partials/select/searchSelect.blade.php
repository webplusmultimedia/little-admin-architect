@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select; @endphp
@props([
	/** @var Select $field */
	'field'
])
<div class=""
    x-data="SelectFormComponent(
    {
            getOptionLabelUsing: async () => {
                return await $wire.getSelectOptionLabelUsing('@js($field->getWireName())')
            },
            getOptionLabelsUsing: async () => {
                return await $wire.getSelectOptionLabelsUsing('@js($field->getWireName())')
            },
            getOptionsUsing: async () => {
                return await $wire.getSelectOptionsUsing('@js($field->getWireName())')
            },
            getSearchResultsUsing: async (search) => {
                return await $wire.getSelectSearchResultsUsing(@js($field->getWireName()), search)
            },
            state: $wire.entangle(@js($field->getWireName())).defer
        }
    )"
>
    {{ $slot }}

</div>
