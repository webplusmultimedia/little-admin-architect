@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn; @endphp
@php /**@var TextColumn $column */
    $column = $getColumn()
@endphp
<td wire:key="{{$column->getWireId()}}">

    <div class="py-4 px-2  min-w-max @if($column->hasColors()) {{$column->getColor($column->getValue())}} @else  text-gray-800 @endif"  >
        {{ $column->getValue() }}
    </div>
</td>

