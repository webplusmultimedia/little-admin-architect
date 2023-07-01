@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

	/**@var Form $form */
	//$form = $this->getForm();
    $button = $form->getSaveButton();
    $buttonCancel = $form->getCancelButton();
@endphp
<div class="py-5 px-2">
    <div class="flex flex-col md:flex-row justify-between bg-white px-5 py-2 mb-8 text-lg font-bold rounded-md shadow-sm">
        <div class="">
            <h2 class="text-2xl !m-0">{{ $this->getTitleForm() }}</h2>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-2">
            @foreach($form->getHeaderActions() as $headerAction)
                {{ $headerAction }}
            @endforeach
        </div>

    </div>

    <div class="" x-data="{}">
        <form wire:submit.prevent="save" x-data="{ livewireId : $wire.__instance.id }" validate>
            {{ $slot ?? NULL }}
            <div @class(["grid gap-5", $form->getColumns()]) >
                @foreach($form->getFields() as $field)
                    {{ $field }}
                @endforeach
            </div>
            <div class="flex justify-end group-btn px-3 py-5 bg-white mt-5 rounded-md border border-gray-200" aria-autocomplete="none">
                <div class="inline-flex items-center space-x-3">
                    <x-little-form::button.submit class="btn-primary" wire:loading.attr="disabled" wire:target="{{ $button->getAction() }}"
                                                  wire:loading.class.delay="opacity-70 cursor-wait"
                                                  x-data="buttonActionComponent"
                                                  x-bind:disabled="$store.laDatas.startUploadFile"
                                                  x-bind:class="{ 'animate-pulse cursor-wait': $store.laDatas.startUploadFile }"

                    >
                        @if($button->hasIcon())
                            <x-little-anonyme::form-components.fields.icons.hero-icon :name="$button->getViewIcon()"/>
                        @endif
                        <span x-show="!$store.laDatas.startUploadFile">{{ $button->getCaption() }}</span>
                            <span x-show="$store.laDatas.startUploadFile">Uploading files ...</span>
                        <x-little-form::icon name="loader" wire:loading.delay="wire:loading.delay"
                                             wire:target="{{ $button->getAction() }}"  class="!opacity-100"
                        />
                    </x-little-form::button.submit>

                    <x-little-form::button.link class="" wire:loading.attr="disabled" wire:target="{{ $button->getAction() }}"
                                                x-bind:disabled="$store.laDatas.startUploadFile"
                                                wire:loading.class.delay="opacity-70 cursor-wait" :url="$buttonCancel->getAction()"
                                                x-bind:class="{ 'opacity-70 cursor-wait': $store.laDatas.startUploadFile }"
                    >
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
