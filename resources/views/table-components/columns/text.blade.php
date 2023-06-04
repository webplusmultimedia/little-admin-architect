@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn; @endphp
@php /**@var TextColumn $column */
    $column = $getColumn()
@endphp
<td wire:key="{{$column->getWireId()}}">

    <div class="py-4 px-2  min-w-max">
      <span @class(["{$column->getColor($column->getValue())} font-medium"=>$column->hasTextColor(),'text-gray-800'=> !$column->hasTextColor()])>
          {{ $column->getValue() }}
      </span>
    </div>
</td>

