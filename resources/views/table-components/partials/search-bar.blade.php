@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\BaseFilter; @endphp
@props([
    'showSearchBar'    ,
    'fieldsToSearch'    ,
    'hasFilters'      ,
    'countActivesFilters',
    'filters'   ,
    'menuKey'   ,
])
<div class="flex justify-end  items-center space-x-3 rounded-lg">
    <div class="flex  w-full bg-gray-50 py-2 px-2  dark:bg-gray-800">
        @if($showSearchBar)

            <div
                class="flex items-center py-1 px-3 border-t border-l border-b rounded-tl-lg  border-slate-300 rounded-l-lg bg-slate-100 dark:bg-gray-600 dark:border-gray-400/40">
                <x-heroicon-s-magnifying-glass class="text-slate-600/70 w-5 dark:text-gray-200"/>
            </div>
            <input type="search" wire:model.debounce.500ms="search"
                   placeholder="{{ __('little-admin-architect::table.search-bar.placeholder',['fieldsText'=>$fieldsToSearch]) }}"
                   class="!border-l-0 rounded-r-lg rounded-l-none border-slate-300 py-2"
            >

        @endif
        @if($hasFilters)
            <div class="justify-end flex items-center relative mx-2"
                 x-data="{filterOpen : false }"
            >
                <button class="rounded-lg p-2 relative focus:ring-2 focus:ring-primary-600"

                        {{--x-on:click="filterOpen = !filterOpen"--}}
                        x-on:key.esc="filterOpen=false"
                        aria-haspopup="menu" aria-controls="table-filters" :aria-expanded="filterOpen"
                        x-on:click="$refs.panel.toggle($event)"
                >
                    @svg('heroicon-s-funnel','w-6 text-slate-400')

                    @if($countActivesFilters)
                        <span class="absolute -top-0.5 -right-1 rounded-full w-5 h-5 text-xs  text-primary-600 bg-white border border-primary-600/30">
                        {{ $countActivesFilters }}
                    </span>
                    @endif
                </button>

                <div x-float.placement.bottom-end.flip.teleport.offset="{ offset : 8 }"
                     x-ref="panel"
                     wire:ignore.self
                     wire:key="{{ $menuKey }}"
                     class="absolute  rounded-md bg-white z-1 shadow-md border border-primary-200 flex flex-col
                                   min-w-[20rem] whitespace-nowrap  divide-y text-sm  p-3 dark:bg-gray-900/95 dark:border-gray-400/40"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:enter="duration-200"
                     x-transition:leave="duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     role="dialog"
                >
                    <ul role="menu">
                        <li role="menuitem">
                            <div class="flex justify-between my-2.5 border-b border-gray-200">
                                <span class="font-bold text-xs md:text-lg md:normal-case  text-black">Filtres</span>
                                @if($countActivesFilters)
                                    <button type="button" wire:click.stop="removeFilters()"
                                            title="{{trans('little-admin-architect::table.filter.remove-filter')}}">
                                        @svg('heroicon-o-trash','h-5 w-5 text-error-500')
                                    </button>
                                @endif
                            </div>
                        </li>
                        @php /** @var BaseFilter $filter */ @endphp
                        @foreach($filters as $filter)
                            @foreach($filter->getFormFields() as $field)
                                <li role="menuitem"
                                    class="pb-3"
                                >
                                    {{ $field}}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>

            </div>
        @endif
    </div>
</div>
