@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table; @endphp
@props([
	/** @var Table $table */
	'table'
])
<div class="flex justify-end  items-center space-x-3 mb-5 py-2 px-2 bg-gray-100 rounded-lg">
    @if($table->showSearchBar())
        <div class="flex  w-full">
            <div class="flex items-center py-1 px-3 border border-slate-300 rounded-l-lg bg-slate-100">
                <x-heroicon-s-magnifying-glass class="text-slate-600 w-5"/>
            </div>
            <input type="search" wire:model.debounce.500ms="search" placeholder="{{ __('little-admin-architect::table.search-bar.placeholder',['fieldsText'=>$table->getFieldSearchText()]) }}"
                   class="!border-l-0 rounded-r-lg rounded-l-none border-slate-300 py-2">
        </div>
    @endif
    <div class="justify-end flex items-center">
        <x-little-anonyme::form-components.fields.icons.filter class="text-primary-500 w-8 stroke-1"/>
    </div>
</div>
