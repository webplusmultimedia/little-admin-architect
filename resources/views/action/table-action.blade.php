<div class="">
    @if($action->getType() === 'link')
        <a href="{{ url($action->getUrl()) }}"
            @class([ $action->getClass(),'inline-flex items-center justify-center space-x-1' ])
            {{ $action->getAlpineDispatch() }}
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" class="w-4 h-4"  aria-hidden="true"/>
            @endif
            <span>{{ $action->getLabel() }}</span>
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" class="w-4 h-4"  aria-hidden="true"/>
            @endif
        </a>
    @else
        <button
            @class([ $action->getClass(),'inline-flex items-center justify-center space-x-1' ])
            wire:click="{{ $action->getWireClickAction() }}"
            wire:loading.attr="disabled" wire:target="mountTableAction"
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" class="w-4 h-4"  aria-hidden="true"/>
            @endif
            <span>{{ $action->getLabel() }}</span>
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" class="w-4 h-4"  aria-hidden="true"/>
            @endif
        </button>


    @endif
</div>
