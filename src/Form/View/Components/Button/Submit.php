<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Button;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Submit extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'fields.button.submit';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        // TODO: Implement setUp() method.
    }
}
