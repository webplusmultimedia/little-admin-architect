<div class="px-6 py-4 bg-white rounded-lg border border-slate-200">
    <h2 class="text-sm lg:text-lg p-0 m-0 text-gray-500">{{ $getLabel() }}</h2>
    <div class="text-3xl font-bold text-slate-800">
        {{ $getValue() }}
    </div>
    @if($description = $getDescription()) <p class="text-xs text-gray-500">{{ $description }}</p> @endif
    @if($button = $getButton)
        {{ $button }}
    @endif
</div>
