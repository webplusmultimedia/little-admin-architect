<div class="w-full md:w-fit">
    @if($action->getType() === 'link')
        <a href="{{ url($action->getUrl()) }}"
            @class([ 'w-full md:w-fit btn inline-flex items-center justify-center space-x-2',$action->getClass() ])
            target="{{$action->getTargetLink()}}"
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-icon :name="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
            @if($action->getLabel())
                <span>{{ $action->getLabel() }}</span>
            @endif
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-icon :name="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
        </a>

    @else
        <button
            type="button"
            @class([ 'btn inline-flex items-center justify-center space-x-2', $action->getClass() ])
            wire:click.stop="{{ $action->getWireClickAction() }}"
            wire:loading.attr="disabled" wire:target="{{  $action->getWireClickAction() }}"
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-icon :name="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
            @if($action->getLabel())
                <span>{{ $action->getLabel() }}</span>
            @endif
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-icon :name="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
        </button>
    @endif
</div>
