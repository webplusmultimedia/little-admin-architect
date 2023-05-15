@php
    /** @var Header $header */
        use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header;
		$header = $getHeader();
@endphp
<th>
    <span>
        {{ $header->getName() }}
    </span>
</th>
