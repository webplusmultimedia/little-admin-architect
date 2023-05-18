@php
    use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;
    /** @var Table $table */
	$table = $getTable();
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
            <a href="{{ $table->linkCreate() }}" class="btn btn-primary">
                Créer un {{ str($table->title)->singular() }}
            </a>
        </div>

    </div>

    <div class="bg-white py-10 px-5 rounded-lg overflow-x-auto" x-data="{}">
        <table class="table-auto w-full text-start divide-y bg-gray-50 {{--text-sm lg:text-lg--}}">
            <thead class="bg-gray-200 border-t text-start">
            <tr>
                @foreach($table->getHeaders() as $header)
                    <x-dynamic-component :component="$header->getComponentView()" :header="$header"/>
                @endforeach
                <th class="w-5">
                    &nbsp;
                </th>
            </tr>
            </thead>
            <tbody class="divide-y">
            @foreach($table->getRecords() as $record)
                <tr wire:key="{{ $table->getLivewireId() . ' .'. $record->id  }}" class="hover:bg-primary-50/50 cursor-pointer">
                    @foreach($table->getColumns() as $column)
                        @php($column->setRecord($record))
                        <x-dynamic-component :component="$column->getView()" :column="$column"/>
                    @endforeach
                    <td class="max-w-max whitespace-nowrap">
                        <a href="{{ $table->linkEdit($record)  }}" class="px-2 py-2 inline-flex items-center space-x-2 text-primary-500">
                            <x-heroicon-s-pencil class="w-4 h-4 text-primary-500"/>
                            <span>Editer</span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class=" py-2 px-5  bg-slate-50 border-t text-primary-400">
        {{ $table->getRecords()->links() }}
    </div>
</div>
