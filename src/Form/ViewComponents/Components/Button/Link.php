<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Button;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;

class Link extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'button.link';
    }
}
