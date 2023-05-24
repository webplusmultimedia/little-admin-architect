@php use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Select; @endphp
@props([
	/** @var Select $field */
	'field'
])
<div class="relative"
     x-cloak
     x-data="SelectFormComponent(
        @js($field->getWireName()),
        @js($field->getLabelDefault()),
        $wire.entangle(@js($field->getWireName())).defer,
        @js($field->getDataRecord()),
        @js($field->isMultiple()),
        @js($field->isSearchable()),
        @js($field->getAllLabelsForValues()),
        @js($field->hasOptionUsing()),
        @js($field->getMessagesContent()),
        @js($field->getSearchDebounce())
    )"
     wire:ignore
    {{ $attributes }}
>
    <div class=""
         role="combobox" aria-autocomplete="list"
         aria-haspopup="true"
         x-bind:aria-expanded="show"
    >
        <div class="choice__wrapper_selected"  x-on:click="show = true"
             :class="{'ring-2 ring-primary-500': show}"
             x-on:keyup.esc="show = false"
        >
            <div class="choice__selected" x-html="defaultLabel" x-show="showChoiceSelected">

            </div>
            <div class="choice__selected text-gray-500" x-text="msgContent.placeholder" x-show="!showChoiceSelected()"></div>
            <div class="flex items-center space-x-2 z-[2]">
                <x-heroicon-o-x-mark class="w-5 hover:text-error-400 transition"
                                     x-show="showChoiceSelected"
                                     x-on:click.stop="resetOptions"
                />
                <x-heroicon-o-chevron-down class="w-5"/>
            </div>
        </div>

    </div>

    <div class="choices__list--dropdown"
         x-bind:aria-expanded="show"
         x-show="show"
         x-cloak
         x-on:click.outside="show = false"

    >
        <input type="text" x-ref="search" class="choice__search" :placeholder="msgContent.searchPrompt" x-bind="search_terms"
               autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list"
               :aria-label="msgContent.searchPrompt"
        >
        <div class="choice__searching__prompt" x-text="msgContent.searchingMessage" x-show="isSearching"></div>
        <div x-ref="list_options" class="choice__list__option" role="listbox" x-show="!isSearching">
        </div>
    </div>
</div>
