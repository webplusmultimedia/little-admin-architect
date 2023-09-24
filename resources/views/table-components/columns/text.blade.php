@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn; @endphp
@php /**@var TextColumn $column */
@endphp
<div @class(["py-4 px-2  min-w-max",$column->getTextAlign()])>
      <span @class(["{$column->getColor($column->getState())} font-medium"=>$column->hasTextColor()])>
          {{ $column->getState() }}
      </span>
</div>

