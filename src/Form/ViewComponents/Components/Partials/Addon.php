<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Partials;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;

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
