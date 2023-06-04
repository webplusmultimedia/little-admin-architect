@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn; @endphp
@php /**@var TextColumn $column */
    $column = $getColumn()
@endphp
<td wire:key="{{$column->getWireId()}}">
    <div class="py-4 px-2  min-w-max text-gray-800">
        <span
            @class(["{$column->getColor($column->getValue())} rounded-full px-3 py-1 text-sm font-medium"=> $column->hasBgColor()])
        >
             {{ $column->getValue() }}
        </span>
    </div>
</td>

