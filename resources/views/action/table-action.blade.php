<div class="w-full md:w-fit">
    @if($action->getType() === 'link')
        <a href="{{ url($action->getUrl()) }}"
           @class([
           'w-full md:w-fit btn inline-flex items-center justify-center space-x-2',
           $action->getClass()
           ])
           target="{{$action->getTargetLink()}}"
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
            @if($action->getLabel())
                <span>{{ $action->getLabel() }}</span>
            @endif
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"/>
            @endif
        </a>

    @else
        <button type="button"
                @class([ 'btn inline-flex items-center justify-center space-x-2', $action->getClass() ])
                @if($action->getWireClickAction())
                    wire:click.stop="{{ $action->getWireClickAction() }}" wire:loading.class="animate-pulse" wire:loading.attr="disabled"
                wire:target="{{  $action->getWireClickAction() }}"
        @else
            {{  $action->getAlpineDataClickAction() }}
            @endif
        >
            @if($action->getIconPosition()==='before' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"
                                     wire:loading.class="animate-spin"
                                     wire:target="{{  $action->getWireClickAction() }}"
                />
            @endif
            @if($action->getLabel())
                <span>{{ $action->getLabel() }}</span>
            @endif
            @if($action->getIconPosition()==='after' and $action->getIcon())
                <x-dynamic-component :component="$action->getIcon()" :class="$action->getIconSize()" aria-hidden="true"
                                     wire:loading.class="animate-spin"
                                     wire:target="{{  $action->getWireClickAction() }}"
                />
            @endif
        </button>
    @endif
</div>
