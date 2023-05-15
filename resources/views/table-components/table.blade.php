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

    <div class="" x-data="{}">
        <table>
            <thead>
             <tr>
                 @foreach($table->getHeaders() as $header)
                     @livewire($header->getComponentView(),['header' => $header])
                 @endforeach

             </tr>
            </thead>
        </table>
        @foreach($table->getRecords() as $record)
        <div class="py-2">
          Id :   {{$record->id}} -
          Titre :   {{$record->titre}} -
           Tarif : {{$record->tarif_du_jeu}}
        </div>
        @endforeach
            {{ $table->getRecords()->links() }}
    </div>
</div>
