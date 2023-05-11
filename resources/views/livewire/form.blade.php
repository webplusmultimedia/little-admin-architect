<div class="" wire:key="">
    @if($initialized)
        <x-dynamic-component :component="$form->getView()"   :form="$form" />
    @else
        <div class="">... Wait until ...</div>
    @endif

</div>
