<x-little-anonyme::widgets.wrappers.wrapper class="flex flex-col gap-y-3">
    <div class="flex items-center gap-x-2">
        @if($tag = $getIcon())
            @svg($tag,$getIconClass())
        @endif
        <h2 class="text-sm lg:text-lg p-0 m-0 text-gray-500">{{ $getLabel() }}</h2>
    </div>

    <div class="flex items-center justify-between">
        <div>
            <div class="text-3xl xl:text-5xl font-bold text-slate-800">
                {{ $getValue() }}
            </div>
            @if($description = $getDescription())
                <div class="text-xs text-gray-500">
                    {{ $description }}

                </div>
            @endif
        </div>
        @if($button = $getButton)
            {{ $button }}
        @endif
    </div>



</x-little-anonyme::widgets.wrappers.wrapper>
