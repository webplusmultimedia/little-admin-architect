@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\BaseFilter; use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table; @endphp
@props([
	/** @var Table $table */
	'table'
])
<div class="flex justify-end  items-center space-x-3 mb-5">
    @if($table->showSearchBar())
        <div class="flex  w-full bg-gray-100 py-2 px-2 rounded-lg">
            <div class="flex items-center py-1 px-3 border border-slate-300 rounded-l-lg bg-slate-100">
                <x-heroicon-s-magnifying-glass class="text-slate-600 w-5"/>
            </div>
            <input type="search" wire:model.debounce.500ms="search"
                   placeholder="{{ __('little-admin-architect::table.search-bar.placeholder',['fieldsText'=>$table->getFieldSearchText()]) }}"
                   class="!border-l-0 rounded-r-lg rounded-l-none border-slate-300 py-2"
            >
        </div>
    @endif
    @if($table->hasFilters())
        <div class="justify-end flex items-center relative"
             x-data="{filterOpen : false }"
        >
            <button class="rounded-full p-3 relative"
                    :class="{'bg-primary-500/10' : filterOpen }"
                    x-on:click="filterOpen = !filterOpen"
                    x-on:keydown.esc="filterOpen=false"
                    aria-haspopup="menu" aria-controls="table-filters" :aria-expanded="filterOpen"
            >
                <x-little-anonyme::form-components.fields.icons.filter
                    id="table-filters"
                    class="text-primary-500 w-5 stroke-3"
                />
                @if($table->getCountActifFilters())
                    <span class="absolute -top-0.5 -right-1 rounded-full w-5 h-5 text-xs  text-primary-600 bg-primary-500/10">
                        {{ $table->getCountActifFilters() }}
                    </span>
                @endif
            </button>

            <x-little-anonyme::table-components.table-filters
                class="absolute right-0 top-[calc(100%_+_1rem)] rounded-md bg-white z-20 shadow-md border border-primary-200 flex flex-col
                                   min-w-[20rem] whitespace-nowrap  divide-y text-sm  p-3"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:enter="duration-200"
                x-transition:leave="duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-show="filterOpen"
                x-on:click.outside="filterOpen=false"
                role="menu"
            >
                <ul role="menu">
                    @php /** @var BaseFilter $filter */ @endphp
                    @foreach($table->getFilters() as $filter)

                            @foreach($filter->getFormFields() as $field)
                            <li role="menuitem"
                                class="pb-3"
                            >
                                {{ $field}}
                            </li>
                            @endforeach

                    @endforeach
                    <li role="menuitem"

                        wire:click.stop="removeFilters()"
                    >
                        <span class="text-sm text-danger font-semibold text-right underline" role="button" aria-description="remove filters">{{ trans('little-admin-architect::table.filter.remove-filter') }}</span>
                    </li>
                </ul>

            </x-little-anonyme::table-components.table-filters>

        </div>
    @endif
</div>
