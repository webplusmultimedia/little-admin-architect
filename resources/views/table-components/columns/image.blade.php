@php use Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\ImageColumn; @endphp
@php /**@var ImageColumn $column */
@endphp
<td wire:key="{{$column->getWireId()}}">
    <div class="flex  items-center justify-start  min-w-max text-gray-800">
        @if($column->getState())
            <span><img src="{{ $column->getUrlForCroppa() }}" alt="image" class="object-cover w-12" loading="lazy"></span>
        @endif
    </div>
</td>

