@php
    use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form;use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder;
	$requiredCsrfToken = in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE']);
    $requiredMethodSpoofing = in_array($method, ['PUT', 'PATCH', 'DELETE']);
	/**@var Form $form */
	$form = $getForm()
@endphp
<div class="py-3 px-2">
    <h1 class="text-2xl mb-5">{{ __($form->title) }}</h1>
    <div class="bg-gray-50 px-5 py-8">
        <form wire:submit.prevent="save" >
            @if($requiredCsrfToken)
                @csrf
            @endif
            @if($requiredMethodSpoofing)
                @method($method)
            @endif
            {{ $slot ?? null }}
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
