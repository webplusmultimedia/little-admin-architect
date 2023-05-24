<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Layouts;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Container extends AbstractComponent
{
    public function __construct(
        \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Layouts\Container $field,
        public null|string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'layouts.container';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        $this->field = $field;
        //$this->name = $field->getName();
    }
}
