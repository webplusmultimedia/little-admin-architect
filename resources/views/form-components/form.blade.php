@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;
    use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;

	/**@var Form $form */
	$form = $getForm();
    $button = $form->getButton();
@endphp
<div class="py-3 px-2">
    <h1 class="text-2xl mb-5">{{ __($form->title) }}</h1>
    <div class="bg-gray-50 px-1 py-8 border " x-data="{}">
        <form wire:submit.prevent="save" x-data="{ livewireId : $wire.__instance.id }">
            {{ $slot ?? NULL }}
            <div {{ $attributes->class("grid gap-2")->merge(['class'=>$form->getColumns()]) }}>
                @foreach($form->getFields() as $field)
                    <x-dynamic-component :component="$field->getFieldView()"  :field="$field" />
                @endforeach
            </div>
            <div class="flex justify-end group-btn px-3" aria-autocomplete="none">
                <x-little-form::button.submit class="btn-primary" wire:loading.attr="disabled" wire:target="{{ $button->getAction() }}" wire:loading.class.delay="opacity-70 cursor-wait">
                    @if($button->hasIcon())
                        <x-little-anonyme::form-components.fields.icons.hero-icon :name="$button->getViewIcon()"/>
                    @endif
                   <span>{{ $button->getCaption() }}</span><x-little-form::icon name="loader"  wire:loading.delay="wire:loading.delay" wire:target="{{ $button->getAction() }}" class="!opacity-100"/>
                </x-little-form::button.submit>
            </div>
        </form>
    </div>
</div>
