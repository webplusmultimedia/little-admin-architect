@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\ImageColumn; @endphp
@php /**@var ImageColumn $column */
@endphp
<td wire:key="{{$column->getWireId()}}">
    <div class="flex  items-center justify-center w-12 h-12  min-w-max text-gray-800">
        @if($column->getState())
            <img src="{{ (Croppa::url($column->getUrlForCroppa(),60,50)) }}" alt="image" class="object-cover w-12">
        @endif
    </div>
</td>

