@php
    /** @var Header $header */
        use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;
		$header = $getHeader();
@endphp
<th class="text-start">
    <button type="button" class="inline-flex space-x-2 items-center py-2 px-2">
        <span class="">
            {{ $header->getLabel() }}
        </span>
        @if($header->isSortable())
            <span>
                <x-heroicon-m-arrow-down class="text-gray-400 w-3"/>
            </span>
        @endif
    </button>
</th>
