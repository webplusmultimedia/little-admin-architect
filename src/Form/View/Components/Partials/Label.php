<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Contrats\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Label extends AbstractComponent
{


    public function __construct(public string|null $label, public string|null $id = null, public bool $showRequired = false,public bool $wrappedWithMargin = true)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'fields.partials.label';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        // TODO: Implement setUp() method.
    }
}
