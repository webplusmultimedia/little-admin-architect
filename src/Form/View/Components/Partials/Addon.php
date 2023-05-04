<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Partials;

use Closure;
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
}
