@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select; @endphp
@props([
	/** @var Select $field */
	'field'
])
<div class=""
    x-data="SelectFormComponent(
    {
            getOptionLabelUsing: async () => {
                return await $wire.getSelectOptionLabel('@js($field->getWireName())')
            },
            getOptionLabelsUsing: async () => {
                return await $wire.getSelectOptionLabels('@js($field->getWireName())')
            },
            getOptionsUsing: async () => {
                return await $wire.getSelectOptions('@js($field->getWireName())')
            },
            getSearchResultsUsing: async (search) => {
                return await $wire.getSelectSearchResults(@js($field->getWireName()), search)
            },
            state: $wire.entangle(@js($field->getWireName())).defer
        }
    )"
>
    {{ $slot }}

</div>
