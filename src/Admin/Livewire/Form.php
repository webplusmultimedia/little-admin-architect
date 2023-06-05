<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\ComponentForm;

class Form extends ComponentForm
{
    public function render(): View
    {
        return view('little-views::livewire.form', $this->formDatas);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function save(): void
    {
        $this->form->saveDatasForm($this);
    }
}
