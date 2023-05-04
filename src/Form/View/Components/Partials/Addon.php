<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Addon extends AbstractComponent
{
    public function __construct(public string|Closure $addon)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.addon';
    }

    protected function setUp(Field $field): void
    {
        // TODO: Implement setUp() method.
    }
}
