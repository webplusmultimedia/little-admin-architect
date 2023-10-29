<div
    class="modal__overlay flex items-center justify-center cursor-pointer"
    x-cloak
    x-data="ModalComponent({name:$wire.name})"
    x-show="show"
    x-on:click.self="closeModal"
>
    {{-- Modal --}}
    <div id="{{ $name }}" tabindex="-1" aria-labelledby="{{ $name }}Label" aria-hidden="true"
         @class(['modal cursor-default',$maxWidth])

         x-show="show && showActiveComponent"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        @forelse($components as $id => $component)
            <div x-show.immediate="activeComponent === '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}" class="w-full">
                @livewire($component['name'], $component['attributes'], 1)
            </div>
        @empty
        @endforelse
    </div>
</div>
