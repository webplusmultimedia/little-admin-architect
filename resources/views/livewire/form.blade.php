<div class="" wire:key="">
    @if($initialized)
        <x-dynamic-component :component="$form->getView()"   :form="$form" />
    @else
        <div class="container mx-auto m-16">
            <div class="bg-white py-5 px-5 rounded-lg ">
                ... Wait until ...
            </div>
        </div>
    @endif
</div>
