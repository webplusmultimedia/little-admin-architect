@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;
	$requiredCsrfToken = in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE']);
    $requiredMethodSpoofing = in_array($method, ['PUT', 'PATCH', 'DELETE']);
	/**@var Form $form */
	$form = $getForm()
@endphp
<div class="py-3 px-2">
    <h1 class="text-2xl mb-5">{{ __($form->title) }}</h1>
    <div class="bg-gray-50 px-5 py-8 border ">

        <form wire:submit.prevent="save">
            {{ $slot ?? NULL }}
            <div {{ $attributes->class("grid gap-4")->merge(['class'=>$form->getColumns()]) }}>
                @foreach($form->getFields() as $field)
                    <x-dynamic-component :component="$field->getFieldView()" :name="$field->name"  :label="$field->getLabel()"  :field="$field" />
                @endforeach
            </div>
            <div class="group-btn" aria-autocomplete="none">
                <x-little-form::button.submit class="btn-primary">Enregistrer</x-little-form::button.submit>
            </div>
        </form>
    </div>


</div>

@php

    if($bind) {
        app(FormBinder::class)->unbindLastDataBatch();
    }
    if($errorBag) {
        app(FormBinder::class)->unbindErrorBag();
    }
    if($wire) {
        app(FormBinder::class)->unbindLastLivewireModifier();
    }

@endphp
