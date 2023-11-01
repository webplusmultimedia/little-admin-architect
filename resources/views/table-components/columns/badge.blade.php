<div class="py-4 px-2  min-w-max text-gray-800">
        <span
            @class(["{$getColor($getState())} rounded-full px-3 py-1 text-sm font-medium"=> $hasBgColor()])
        >
             {{ $getState() }}
        </span>
</div>

