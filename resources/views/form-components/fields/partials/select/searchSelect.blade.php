@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Select; @endphp
@props([
	/** @var Select $field */
	'field'
])
<div
     @class(['disabled__field' => $field->isDisabled(),"relative"])
     x-cloak
     x-data="SelectFormComponent(
     {
        componentId: @js($field->getStatePath()),
        defaultLabel: @js($field->getLabelDefault()),
        state : $wire.entangle(@js($field->getStatePath())).defer,
        defaultValue : @js($field->getState()),
        isMultiple : @js($field->isMultiple()),
        isSearchable : @js($field->isSearchable()),
        optionsUsing : @js($field->getAllLabelsForValues()),
        hasOptionUsing : @js($field->hasOptionUsing()),
        msgContent : @js($field->getMessagesContent()),
        searchDebounce : @js($field->getSearchDebounce()),
     }
    )"
     wire:ignore
        {{ $attributes }}
>
    <div class=""
         role="combobox" aria-autocomplete="list"
         aria-haspopup="true"
         x-bind:aria-expanded="show"
    >
        <x-little-anonyme::form-components.fields.partials.label class="form-label"
                                                                 :id="$field->getId()"
                                                                 :is-required="$field->isRequired()"
                                                                 x-on:click="show = true"
        >
            {{ $field->getLabel() }}
        </x-little-anonyme::form-components.fields.partials.label>
        <div class="choice__wrapper_selected" x-on:click="show = true"
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
        <div class="choice__searching__prompt" x-text="msgContent.searchingNoMessage" x-show="showNoResult"></div>
        <div x-ref="list_options" class="choice__list__option" role="listbox" x-show="!isSearching">
        </div>
    </div>
</div>
