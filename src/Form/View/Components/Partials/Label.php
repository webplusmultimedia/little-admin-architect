<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Label extends AbstractComponent
{
    public function __construct(public string|null $label, public string|null $id = null, public bool $showRequired = false)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.label';
    }

    protected function setUp(Field $field): void
    {
        // TODO: Implement setUp() method.
    }
}
