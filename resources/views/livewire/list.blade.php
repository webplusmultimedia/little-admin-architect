<div>
    @foreach($widgets as $key=>$widget)
        <div class="py-4">
            @livewire(LittleAdminArchitect::resolveLivewireComponent($widget),[...$widget::getDefaultProperties()])
            {{--{{ LittleAdminArchitect::resolveLivewireComponent($widget) }}--}}
        </div>
    @endforeach
    <div class="" wire:key="{{$id}}">
        @livewire($component,['pageRoute' => $pageRoute])
    </div>
</div>
