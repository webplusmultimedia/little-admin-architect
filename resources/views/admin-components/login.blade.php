@php
    $button = $form->getSaveButton();
@endphp
<div class="" x-data="{}">
    <form wire:submit.prevent="authenticate" x-data="{ livewireId : $wire.__instance.id }" novalidate>
        {{ $slot ?? NULL }}
        <div class="grid gap-5 {{  $form->getColumns() }}">
            @foreach($form->getFields() as $field)
                <x-dynamic-component :component="$field->getFieldView()" :field="$field"/>
            @endforeach
        </div>
        <div class="flex justify-end group-btn px-3 py-5 bg-white mt-5 rounded-md border border-gray-200" aria-autocomplete="none">
            <div class="inline-flex items-center space-x-3">
                <x-little-form::button.submit class="btn-primary" wire:loading.attr="disabled" wire:target="{{ 'authenticate' }}"
                                              wire:loading.class.delay="opacity-70 cursor-wait">
                    @if($button->hasIcon())
                        <x-little-anonyme::form-components.fields.icons.hero-icon :name="$button->getViewIcon()"/>
                    @endif
                    <span>{{ $button->getCaption() }}</span>
                    <x-little-form::icon name="loader" wire:loading.delay="wire:loading.delay" wire:target="{{ $button->getAction() }}" class="!opacity-100"/>
                </x-little-form::button.submit>

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

        </div>
    </form>
</div>
