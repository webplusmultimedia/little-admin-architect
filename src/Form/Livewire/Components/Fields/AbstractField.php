<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields;

abstract class AbstractField
{
    protected string $prefixName = 'data';

    protected string $view = 'input';

    public function getFieldView(): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $this->view;
    }

    protected function getViewComponent(string $view): string
    {
        return config('little-admin-architect.blade-prefix') . '::' . $view;
    }
}
