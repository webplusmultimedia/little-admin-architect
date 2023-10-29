@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

	/**@var Form $form */
    $button = $form->getSaveButton();
    $buttonCancel = $form->getCancelButton();
@endphp
<div x-data="{}" @class(["py-5 px-2 dark:bg-gray-80" => !$form->hasModal(),"py-0 px-0 dark:bg-gray-800 rounded-2xl  dark:border dark:border-gray-400/40  overflow-hidden" => $form->hasModal()])>
    <div
        @class([
            "flex flex-col md:flex-row justify-between items-center bg-white text-lg font-bold  shadow-sm",
            " px-5 py-2 mb-8  rounded-lg dark:bg-gray-700 border border-gray-200 dark:border-gray-400/20" => !$form->hasModal(),
            "py-7 px-5 mb-8 border-b dark:border-gray-400/50 dark:bg-gray-800 " => $form->hasModal()
        ])
    >
        <div class="">
            <h2 class="text-2xl !m-0">{{ $form->getTitleForm() }}</h2>
            @if(!$form->hasModal())
                <p class="inline-flex items-center space-x-2 text-sm font-normal ">
                    <span><a href="{{ $form->linkIndex() }}">{{ $form->getResourcePage()::getPluralModelLabel() }}</a></span>
                    @if($form->getBreadcrumb())
                        <span>/</span><span class=""><a href="{{ $form->linkEdit($form->getRecord()) }}">{{ $form->getBreadcrumb() }}</a></span>
                    @endif
                    <span>/</span><span class="text-gray-400">{{ $form->getTitleMode() }} </span>
                </p>
            @endif
        </div>

        <div class="flex flex-col md:flex-row items-center gap-2">
            @foreach($form->getHeaderActions() as $headerAction)
                {{ $headerAction }}
            @endforeach
        </div>

    </div>

    <div x-data="{}">
        <form wire:submit.prevent="save" x-data="{ livewireId : $wire.__instance.id }" validate>
            {{ $slot ?? NULL }}
            <div @class(["grid gap-5", $form->getColumns(),'max-h-[calc(100vh_-_15em)] md:max-h-[calc(100vh_-_20em)] overflow-y-auto px-5'=> $form->hasModal()]) >
                @foreach($form->getFields() as $field)
                    {{ $field }}
                @endforeach
            </div>
            <div aria-autocomplete="none"
                @class(
                    [

                        "flex justify-end group-btn px-3 py-5","rounded-md border mt-5 bg-white border-gray-200 mt-2 dark:bg-gray-700 dark:border-gray-400/50 " => !$form->hasModal(),
                        "border-t border-gray-200 bg-gray-50  shadow-lg mt-8 border-gray-400/50 dark:bg-gray-800" => $form->hasModal()
                    ]
                )
            >
                <div class="inline-flex items-center space-x-3">
                    <x-little-anonyme::form-components.fields.button.submit class="btn-primary" wire:loading.attr="disabled"
                                                                            wire:target="{{ $button->getAction() }}"
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
                        <x-little-anonyme::form-components.fields.icons.loader wire:loading.delay="wire:loading.delay"
                                                                               wire:target="{{ $button->getAction() }}" class="!opacity-100"
                        />
                    </x-little-anonyme::form-components.fields.button.submit>
                    @if(!$form->hasModal())
                        <x-little-anonyme::form-components.fields.button.link class="" wire:loading.attr="disabled" wire:target="{{ $button->getAction() }}"
                                                                              x-bind:disabled="$store.laDatas.startUploadFile"
                                                                              wire:loading.class.delay="opacity-70 cursor-wait" :url="$buttonCancel->getAction()"
                                                                              x-bind:class="{ 'opacity-70 cursor-wait': $store.laDatas.startUploadFile }"
                        >
                            @if($buttonCancel->hasIcon())
                                <x-little-anonyme::form-components.fields.icons.hero-icon :name="$buttonCancel->getViewIcon()"/>
                            @endif
                            <span>{{ $buttonCancel->getCaption() }}</span>
                        </x-little-anonyme::form-components.fields.button.link>
                    @else
                        <x-little-anonyme::form-components.fields.button.text wire:loading.attr="disabled" wire:target="{{ $buttonCancel->getAction() }}"
                                                                              wire:loading.class.delay="opacity-70 cursor-wait"
                        >
                            @if($buttonCancel->hasIcon())
                                <x-little-anonyme::form-components.fields.icons.hero-icon :name="$buttonCancel->getViewIcon()"/>
                            @endif
                            <span>{{ $buttonCancel->getCaption() }}</span>
                        </x-little-anonyme::form-components.fields.button.text>
                    @endif

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div>
        {{ $form->getActionModal() }}
    </div>

</div>
