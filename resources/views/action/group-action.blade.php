<div class="justify-end flex items-center relative"
     x-data="{rowActionOpen : false ,id : $id('row-action') }"
     x-id="['row-action']"
>
    <button class="rounded-full p-3 relative"
            :class="{'bg-primary-500/10' : rowActionOpen }"
            x-on:click="$refs.panel.toggle"
            x-on:keydown.esc="rowActionOpen=false"
            aria-haspopup="menu" :aria-controls="id" :aria-expanded="rowActionOpen"
    >
        <x-heroicon-s-ellipsis-vertical
            x-bind:id="id"
            class="text-slate-500 w-5 h-5"
        />
    </button>
    <div x-float.placement.bottom-end.flip.teleport.offset="{ offset : -5 }"
         x-ref="panel"
        class="absolute  rounded-md bg-white z-10 shadow-md border border-primary-200 flex flex-col
                                   min-w-[10rem] whitespace-nowrap  divide-y text-sm dark:bg-gray-800 dark:text-white dark:border-gray-400/40"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:enter="duration-200"
        x-transition:leave="duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-show="rowActionOpen"
        x-on:click.outside="rowActionOpen=false"
        role="menu"
    >
        <ul role="menu">
            @foreach($actions as $action)
                @if($action->authorize())
                    <li role="menuitem"
                        class="p-1 hover:text-slate-300 hover:bg-gray-100 dark:hover:bg-transparent dark:hover:text-transparent"
                    >
                        {{ $action }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
