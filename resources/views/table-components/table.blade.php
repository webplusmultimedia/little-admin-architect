@php

    use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;
    /** @var Table $table */
	$table = $getTable();
@endphp
<div class="py-5 px-2">
    <div class="flex flex-col bg-white px-5 py-2 mb-8">
        <h1 class="text-2xl mb-0">{{ __($table->title) }}</h1>
        <p>
            title / xxxx / edit
        </p>
    </div>

    <div class="bg-white py-10 px-5 rounded-md" x-data="{}">
        <table class="table-auto w-full text-start divide-y ">
            <thead class="bg-gray-100 border-t text-start">
            <tr>
                @foreach($table->getHeaders() as $header)
                    <x-dynamic-component :component="$header->getComponentView()" :header="$header"/>
                @endforeach
            </tr>
            </thead>
            <tbody class="divide-y">
            @foreach($table->getRecords() as $record)
                <tr wire:key="{{ $table->getLivewireId() . ' .'. $record->id  }}">
                    @foreach($table->getColumns() as $column)
                        @php($column->setRecord($record))
                        <x-dynamic-component :component="$column->getView()" :column="$column"/>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class=" py-2 px-5  bg-slate-50 border-t ">
            {{ $table->getRecords()->links() }}
        </div>
    </div>
</div>
