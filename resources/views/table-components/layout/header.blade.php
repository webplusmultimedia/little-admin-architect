@php
    /** @var Header $header */
        use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;
		$header = $getHeader();
		$sortDirection = $getSortDirection();
		$sortColumn = $getSortColumn();
@endphp
<th class="text-start ">
    <button type="button" class="inline-flex space-x-2 items-center py-2 px-2 min-w-max text-sm  uppercase"
            :class="{'cursor-default' : {{ $header->isSortable()?0:1 }} }"
            @if($header->isSortable())  wire:click="sortable('{{$header->getName()}}')" @endif
    >
        <span class="">
            {{ $header->getLabel() }}
        </span>
        @if($header->isSortable())
            @if($sortColumn === $header->getName() && $sortDirection==='asc')
                <span>
                    <x-heroicon-m-arrow-down class="text-primary-600 w-3"/>
                </span>
            @elseif($sortColumn === $header->getName() && $sortDirection==='desc')
                <span>
                    <x-heroicon-m-arrow-up class="text-primary-600 w-3"/>
                </span>
            @else
                <span>
                <x-heroicon-m-arrow-down class="text-gray-400 w-3"/>
            </span>
            @endif
        @endif
    </button>
</th>
