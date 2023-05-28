@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;

	/**@var Form $form */
	$form = $getForm();
    $button = $form->getSaveButton();
    $buttonCancel = $form->getCancelButton();
@endphp
<div class="py-5 px-2">
    <div class="flex flex-col bg-white px-5 py-2 mb-8 text-lg font-bold">
        {{--<h1 >{{ __($form->title) }}</h1>--}}
        <h2 class="text-2xl !m-0">{{ $getTitleForm() }}</h2>
    </div>

    <div class="" x-data="{}">
        <form wire:submit.prevent="save" x-data="{ livewireId : $wire.__instance.id }" novalidate>
            {{ $slot ?? NULL }}
            <div {{ $attributes->class("grid gap-5")->merge(['class'=>$form->getColumns()]) }}>
                @foreach($form->getFields() as $field)
                    <x-dynamic-component :component="$field->getFieldView()" :field="$field"/>
                @endforeach
            </div>
            <div class="flex justify-end group-btn px-3 py-5 bg-white mt-5 rounded-md border border-gray-200" aria-autocomplete="none">
                <div class="inline-flex items-center space-x-3">
                    <x-little-form::button.submit class="btn-primary" wire:loading.attr="disabled" wire:target="{{ $button->getAction() }}"
                                                  wire:loading.class.delay="opacity-70 cursor-wait">
                        @if($button->hasIcon())
                            <x-little-anonyme::form-components.fields.icons.hero-icon :name="$button->getViewIcon()"/>
                        @endif
                        <span>{{ $button->getCaption() }}</span>
                        <x-little-form::icon name="loader" wire:loading.delay="wire:loading.delay" wire:target="{{ $button->getAction() }}" class="!opacity-100"/>
                    </x-little-form::button.submit>

                    <x-little-form::button.link class="" wire:loading.attr="disabled" wire:target="{{ $buttonCancel->getAction() }}"
                                                wire:loading.class.delay="opacity-70 cursor-wait" :url="$buttonCancel->getAction()">
                        @if($buttonCancel->hasIcon())
                            <x-little-anonyme::form-components.fields.icons.hero-icon :name="$buttonCancel->getViewIcon()"/>
                        @endif
                        <span>{{ $buttonCancel->getCaption() }}</span>
                    </x-little-form::button.link>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

            </div>
        </form>
    </div>
</div>
