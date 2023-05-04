<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Caption extends AbstractComponent
{
    public function __construct(public string|null $caption)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.caption';
    }

    protected function setUp(Field $field): void
    {
        // TODO: Implement setUp() method.
    }
}
