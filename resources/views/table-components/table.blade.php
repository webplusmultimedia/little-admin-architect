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
        @foreach($table->getRecords() as $record)
            @dump($record)
        @endforeach
    </div>
</div>
