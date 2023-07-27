<div class="flex items-center">
    @if($action->getType() === 'link')
        <a href="{{ url($action->getUrl()) }}"
            @class([ $action->getClass(),'inline-flex items-center justify-left gap-1 w-full' ])
            {{ $action->getAlpineDispatch() }}
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
            <span>{{ $action->getLabel() }}</span>
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
        </a>
    @else
        <button type="button"
            @class([ $action->getClass(),'inline-flex items-center justify-left gap-1 w-full' ])
            wire:click="{{ $action->getWireClickAction() }}"
            wire:loading.attr="disabled" wire:target="mountTableAction"
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
