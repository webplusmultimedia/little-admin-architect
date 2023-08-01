@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\ImageColumn; @endphp
@php /**@var ImageColumn $column */
@endphp
<td wire:key="{{$column->getWireId()}}">
    <div class="flex  items-center justify-start  min-w-max text-gray-800">
        @if($column->getState())
            <span><img src="{{ (Croppa::url($column->getUrlForCroppa(),60,50)) }}" alt="image" class="object-cover w-12"></span>
        @endif
    </div>
</td>

