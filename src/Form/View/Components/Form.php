<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;

final class Form extends Component
{
    public function __construct(
        protected \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form $form,
        public string $method = 'GET',
        public array|object|null $bind = null,
        public string|null $errorBag = null,
        public string|null $wire = null
    ) {

        if ($bind) {
            app(FormBinder::class)->bindNewDataBatch($bind);
        }
        if ($errorBag) {
            app(FormBinder::class)->bindErrorBag($errorBag);
        }
        if ($wire) {
            app(FormBinder::class)->bindNewLivewireModifier($wire === '1' ? null : $wire);
        }
        $this->method = strtoupper($method);
    }

    public function getForm(): \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form
    {
        return $this->form;
    }


    public function render(): View
    {
        return view('little-views::form-components.form');
    }
}
