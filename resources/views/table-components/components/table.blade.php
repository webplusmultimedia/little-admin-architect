@php use Illuminate\Database\Eloquent\Model;
 use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;
 use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;
@endphp
@props([
    /** @var Header[] $headers */
    'headers',
    /** @var Model[] $header */
    'records' ,
    /** @var Table $table*/
    'table',
])

<table class="table-auto w-full text-start divide-y shadow-sm"
       wire:loading.class="opacity-50"
>

    <x-little-anonyme::table-components.components.partials.Header :headers="$headers"/>

    <tbody class="divide-y">
    @foreach($table->getRecords() as $record)
        <tr wire:key="{{ $table->getLivewireId() . '.tr.'. $record->getKey()  }}" class="hover:bg-primary-50/50 cursor-pointer">
            @foreach($table->getColumns() as $column)
                @php($column->setRecord($record)->livewireId($table->getLivewireId()))
                <x-dynamic-component :component="$column->getView()" :column="$column" :livewireId="$table->getLivewireId()"/>
            @endforeach
            <td class="max-w-max whitespace-nowrap">
                <div class="px-3 inline-flex items-center gap-3">
                    <a href="{{ url($table->linkEdit($record))  }}"
                       class="hover:text-primary-500 bg-white transition text-sm font-bold py-1 px-3 rounded-full border border-primary-200 hover:border-primary-400  inline-flex items-center space-x-1 text-primary-600">
                        <x-heroicon-s-pencil class="w-4 h-4" aria-hidden="true"/>
                        <span>{{ __('little-admin-architect::table.row-button.edit') }}</span>
                    </a>
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
