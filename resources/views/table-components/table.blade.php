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
            <h1 class="text-2xl mb-0">{{ $table->title }}</h1>
            <p class="inline-flex items-center space-x-2 text-sm">
                <span>{{ $table->title }}</span> <span>/</span> <span class="text-gray-400">Liste</span>
            </p>
        </div>
        <div class="flex items-center">
            @foreach($table->getHeaderActions() as $headerAction)
                <x-little-action::table-action :action="$headerAction"/>
            @endforeach
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
                                <div class="px-3 w-full inline-flex gap-2 items-center justify-end">
                                    @foreach($table->getRowActions($record) as $action)
                                        <x-little-action::table-row-action :action="$action"/>
                                    @endforeach
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
    {{  $table->getActionModal() }}
</div>
