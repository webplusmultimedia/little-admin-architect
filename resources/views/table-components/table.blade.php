@php
    use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;
    /** @var Table $table */
	$table = $getTable();
    $sortDirection = $table->getSortDirection();
    $sortColumn = $table->getSortColumn();
@endphp
<div class="py-5 px-2">
    <div class="flex justify-between bg-white px-5 py-2 mb-8">
        <div class="">
            <h1 class="text-2xl mb-0">{{ __($table->title) }}</h1>
            <p class="inline-flex items-center space-x-2 text-sm">
                <span>{{ $table->title }}</span> <span>/</span> <span class="text-gray-400">Liste</span>
            </p>
        </div>
        <div class="flex items-center">
            @if($table->hasModalForm())
                <button  type="button" class="btn btn-success inline-flex items-center justify-center space-x-2"
                      wire:click.stop="showModalForm()"
                >
                    <x-heroicon-s-pencil class="w-4 h-4" aria-hidden="true"/>
                    <span>{{ __('little-admin-architect::table.button.create',['label'=>'un']) }} {{ str($table->title)->singular() }}</span>
                </button>
            @else
                <a href="{{ url($table->linkCreate()) }}" class="btn btn-primary"
                >
                    {{ __('little-admin-architect::table.button.create',['label'=>'un']) }} {{ str($table->title)->singular() }}
                </a>
            @endif

        </div>
    </div>
    <div class="flex flex-col bg-white py-10 px-5 rounded-lg overflow-x-auto" x-data="{}">
        <x-little-anonyme::table-components.partials.search-bar :table="$table"/>
        @if($table->hasRecords())
            <div class=" border-collapse border border-gray-200 rounded-lg overflow-hidden overflow-x-auto">
                <table class="table-auto w-full text-start divide-y shadow-sm"
                       wire:loading.class.delay="opacity-50"
                       x-data="TableComponent({ livewireId : $wire.__instance.id })"
                >
                    <thead class="bg-gray-100 border-t text-start">
                    <tr>
                        @foreach($table->getHeaders() as $header)
                            <x-dynamic-component :component="$header->getComponentView()"
                                                 :header="$header"
                                                 :sort-direction="$sortDirection"
                                                 :sort-column="$sortColumn"
                            />
                        @endforeach
                        <th class="w-5">
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y">
                    @foreach($table->getRecords() as $record)
                        <tr wire:key="{{ $table->getLivewireId() . '.tr.'. $record->getKey()  }}" class="hover:bg-primary-50/50 cursor-pointer">
                            @foreach($table->getColumns() as $column)
                                @php($column->setRecord($record)->livewireId($table->getLivewireId()))
                                <x-dynamic-component :component="$column->getView()" :column="$column" :livewireId="$table->getLivewireId()"/>
                            @endforeach
                            <td class="max-w-max whitespace-nowrap">
                                <div class="px-3 inline-flex items-center gap-3">
                                    @if($table->hasModalForm())
                                        <div  class="hover:text-primary-500 bg-white transition text-sm font-bold py-1 px-3 rounded-full border border-primary-200 hover:border-primary-400  inline-flex items-center space-x-1 text-primary-600"
                                              wire:click="showModalForm({{$record->getKey()}})"
                                        >
                                            <x-heroicon-s-pencil class="w-4 h-4" aria-hidden="true"/>
                                            <span>{{ __('little-admin-architect::table.row-button.edit') }}</span>
                                        </div>
                                    @else
                                        <a href="{{ url($table->linkEdit($record))  }}"
                                           class="hover:text-primary-500 bg-white transition text-sm font-bold py-1 px-3 rounded-full border border-primary-200 hover:border-primary-400  inline-flex items-center space-x-1 text-primary-600">
                                            <x-heroicon-s-pencil class="w-4 h-4" aria-hidden="true"/>
                                            <span>{{ __('little-admin-architect::table.row-button.edit') }}</span>
                                        </a>
                                    @endif

                                    <a href="{{ url($table->linkIndex())  }}"
                                       class="hover:text-error-500 bg-white transition text-sm font-bold py-1 px-3 rounded-full border border-error-200 hover:border-error-400  inline-flex items-center space-x-1 text-error-600 ">
                                        <x-heroicon-s-x-mark class="w-4 h-4 " aria-hidden="true"/>
                                        <span>{{ __('little-admin-architect::table.row-button.delete') }}</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <x-little-anonyme::table-components.partials.no-records/>
        @endif

        <div class=" py-5 px-5    text-primary-400">
            {{ $table->getRecords()->links() }}
        </div>
    </div>

</div>