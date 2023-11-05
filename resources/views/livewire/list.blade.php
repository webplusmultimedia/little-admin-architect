<div>
    <x-little-anonyme::widgets.widgets :widgets="$headerWidgets"/>
    <div class="" wire:key="page-{{$id}}">
        @livewire($component,['pageRoute' => $pageRoute])
    </div>
    <x-little-anonyme::widgets.widgets :widgets="$footerWidgets"/>
</div>
