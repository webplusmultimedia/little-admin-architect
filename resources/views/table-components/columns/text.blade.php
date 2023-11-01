<div @class(["py-4 px-2  min-w-max",$getTextAlign()])>
      <span @class(["{$getColor($getState())} font-medium"=>$hasTextColor()])>
          {{ $getState() }}
      </span>
</div>

