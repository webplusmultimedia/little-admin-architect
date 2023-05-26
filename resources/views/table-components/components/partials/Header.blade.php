@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header; @endphp
@props([
 /** @var Header[] $headers */
 'headers',

])
<thead class="bg-gray-100 border-t text-start">
    <tr>
        @foreach($headers as $header)
            <x-dynamic-component :component="$header->getComponentView()" :header="$header"/>
        @endforeach
        <th class="w-5">
            &nbsp;
        </th>
    </tr>
</thead>
