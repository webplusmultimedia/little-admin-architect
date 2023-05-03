<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;

class Label extends AbstractComponent
{
    public function __construct(public string|null $label, public string|null $id = null)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.label';
    }
}
