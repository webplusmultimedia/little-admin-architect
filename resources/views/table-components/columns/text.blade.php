@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn; @endphp
@php /**@var TextColumn $column */
@endphp
<td wire:key="{{$column->getWireId()}}">
    <div class="py-4 px-2  min-w-max">
      <span @class(["{$column->getColor($column->getState())} font-medium"=>$column->hasTextColor(),'text-gray-800'=> !$column->hasTextColor()])>
          {{ $column->getState() }}
      </span>
    </div>
</td>

