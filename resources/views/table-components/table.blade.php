@php
    use Webplusmultimedia\LittleAdminArchitect\Support\Action\GroupAction;use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;
    /** @var Table $table */
    $sortDirection = $table->getSortDirection();
    $sortColumn = $table->getSortColumn();
@endphp
<div class="my-10">
    <div class="flex justify-between bg-white px-5 py-3 mb-8 dark:bg-gray-800">
        <div class="flex flex-col">
            <div class="inline-flex items-center gap-2">
                <h1 class="text-2xl m-0">{{ $table->title }}</h1>
                <span class="text-sm text-primary">{{ $table->getRecords()->total() }}</span>
            </div>


        </div>
        <div class="flex items-center gap-2">
            @foreach($table->getHeaderActions() as $headerAction)
                @if($headerAction->authorize())
                    {{ $headerAction }}
                @endif
            @endforeach
        </div>
    </div>
    <div class="flex flex-col bg-white  rounded-lg border dark:bg-gray-800 dark:border-gray-400/40 dark:text-white" x-data="{}">
        <x-little-anonyme::table-components.partials.search-bar :table="$table"/>
        @if($table->hasRecords())
            <div class="  overflow-hidden overflow-x-auto  ">
                <table class="border-collapse table-auto   w-full rounded-lg text-start divide-y shadow-sm dark:text-white dark:border-gray-600"
                       wire:loading.class.delay="opacity-50"
                       x-data="TableComponent({ livewireId : $wire.__instance.id })"
                >
                    <thead class="bg-slate-200/70  text-start  dark:bg-gray-700">
                        <tr class=" dark:border-gray-600">
                            @foreach($table->getHeaders() as $header)
                                {{ $header }}
                            @endforeach
                            @if($table->hasRowsAction())
                                <th class="w-5">
                                    &nbsp;
                                </th>
                            @endif

                        </tr>
                    </thead>
                    <tbody class="divide-y">
                    @foreach($table->getRecords() as $record)
                        <tr wire:key="{{ $table->getLivewireId() . '.tr.'. $record->getKey()  }}"
                            class="hover:bg-primary-50/50 cursor-pointer dark:border-gray-600 dark:hover:bg-gray-700/50">
                            @foreach($table->getColumns() as $column)
                                @php($column->setRecord($record)->livewireId($table->getLivewireId()))
                                {{ $column }}
                            @endforeach
                            @if($table->hasRowsAction())
                                <td class="max-w-max whitespace-nowrap">
                                    <div class="w-full inline-flex gap-2 items-center justify-end">
                                        @foreach($table->getRowActions($record) as $action)
                                            @if($action instanceof GroupAction)
                                                {{ $action }}
                                            @elseif($action->authorize())
                                                {{ $action }}
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <x-little-anonyme::table-components.partials.no-records/>
        @endif

        <div class=" py-5  px-3 border-t  dark:border-gray-400/40">
            @if(!$table->getRecords()->hasPages())
                <div class="">Nombre d'éléments : {{ $table->getRecords()->count() }}</div>
            @else
                {{ $table->getRecords()->links() }}
            @endif
        </div>
    </div>
    @if($table->hasRowsAction())
        {{  $table->getActionModal() }}
    @endif
</div>
