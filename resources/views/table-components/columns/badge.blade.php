@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\TextColumn; @endphp
@php /**@var TextColumn $column */
@endphp
<div class="py-4 px-2  min-w-max text-gray-800">
        <span
            @class(["{$column->getColor($column->getState())} rounded-full px-3 py-1 text-sm font-medium"=> $column->hasBgColor()])
        >
             {{ $column->getState() }}
        </span>
</div>

