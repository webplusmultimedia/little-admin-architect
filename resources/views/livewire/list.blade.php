<div>
    <x-little-anonyme::widgets.widgets :widgets="$widgets"/>
    <div class="" wire:key="{{$id}}">
        @livewire($component,['pageRoute' => $pageRoute])
    </div>
</div>
