<form wire:submit.prevent="{{ $formAction }}">
    <div
        class="modal__overlay flex items-center justify-center"
        x-cloak
        x-data="{{ $alpineData  }}"
        x-show="isOpen"
        @click.self="{{ $alpineCloseModal }}"

        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        wire:ignore.self
    >
        {{-- Modal --}}
        <div class="modal {{ $getMaxWidth() }} dark:bg-gray-800 dark:border dark:border-gray-400/20" :id="id" tabindex="-1" :ariaLabelledby="id +'-Label'" aria-hidden="true"
        >
            {{ $getContent() }}
        </div>
    </div>
</form>
