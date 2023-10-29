<x-little-anonyme::widgets.wrappers.widget>
     <x-little-anonyme::widgets.wrappers.grid :columns="$this->getColumnSpan()">
         @foreach($this->getCachedStats() as $stat)
             {{ $stat }}
         @endforeach
     </x-little-anonyme::widgets.wrappers.grid>
</x-little-anonyme::widgets.wrappers.widget>
