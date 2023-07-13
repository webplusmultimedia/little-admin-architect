@php
    $button = $form->getSaveButton();
@endphp
<div class="" x-data="{}">
    <h2 class="text-2xl md:text-2xl font-bold mb-12">{{ $form->getTitle() }}</h2>
    <form wire:submit.prevent="{{ $button->getAction() }}" x-data="{ livewireId : $wire.__instance.id }" novalidate>
        {{ $slot ?? NULL }}
        <div class="grid gap-5 {{  $form->getColumns() }}">
            @foreach($form->getFields() as $field)
                {{  $field }}
            @endforeach
        </div>
        <div class="flex justify-end group-btn px-3 py-5 bg-white mt-5   border-t border-gray-200" aria-autocomplete="none">
            <div class="inline-flex items-center space-x-3">
                <x-little-anonyme::form-components.fields.button.submit
                    class="btn-primary"
                    wire:loading.attr="disabled"
                    wire:target="{{ $button->getAction() }}"
                    wire:loading.class.delay="opacity-70 cursor-wait"
                >
                    @if($button->hasIcon())
                        <x-little-anonyme::form-components.fields.icons.hero-icon :name="$button->getViewIcon()"/>
                    @endif
                    <span>{{ $button->getCaption() }}</span>
                    <x-little-anonyme::form-components.fields.icons.loader
                        name="loader" wire:loading.delay="wire:loading.delay"
                        wire:target="{{ $button->getAction() }}"
                        class="!opacity-100"
                    />
                </x-little-anonyme::form-components.fields.button.submit>
            </div>

        </div>
    </form>
</div>
