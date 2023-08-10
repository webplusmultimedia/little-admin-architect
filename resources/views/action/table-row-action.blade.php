<div class="flex items-center">
    @if($action->getType() === 'link')
        <a href="{{ url($action->getUrl()) }}"
           @class([ $action->getClass(),'inline-flex items-center justify-left w-full gap-1 transition',
           "hover:text-white hover:bg-".str($action->getColor())->trim()."-500  rounded-md p-2 hover:no-underline" => $action->isInGroupAction() ])
           {{ $action->getAlpineDispatch() }}
           target="{{$action->getTargetLink()}}"
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
            @if($action->showLabel())
                <span>{{ $action->getLabel() }}</span>
            @endif
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
        </a>
    @else
        <button type="button"
                @class([ $action->getClass(),'inline-flex items-center justify-left gap-1 w-full',
           "hover:text-white hover:bg-".str($action->getColor())->trim()."-500 rounded-md p-2 hover:no-underline" => $action->isInGroupAction() ])
                wire:click="{{ $action->getWireClickAction() }}"
                wire:loading.attr="disabled" wire:target="{{  $action->getWireClickAction() }}"
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
            <span>{{ $action->getLabel() }}</span>
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
        </button>
    @endif
</div>
