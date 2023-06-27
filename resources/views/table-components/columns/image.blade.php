@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\ImageColumn; @endphp
@php /**@var ImageColumn $column */
    $column = $getColumn()
@endphp
<td wire:key="{{$column->getWireId()}}">
    <div class="flex w-10 h-10  min-w-max text-gray-800">
        @if($column->getState())
            <img src="{{ $column->getFileUrl() }}" alt="image" class="object-cover w-full">
        @endif

    </div>
</td>

