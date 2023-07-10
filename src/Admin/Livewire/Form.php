<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;

class Form extends BaseForm implements Htmlable
{
    public function render(): View
    {
        $this->form->dehydrateState();

        return view('little-views::livewire.form', $this->formDatas);
    }

    public function toHtml(): string
    {

        return $this->render()->render();
    }
}
