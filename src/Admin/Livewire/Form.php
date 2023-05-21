<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class Form extends ComponentForm implements Htmlable
{
    public function render(): View
    {
        return view('little-views::livewire.form', $this->formDatas);
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }
}
