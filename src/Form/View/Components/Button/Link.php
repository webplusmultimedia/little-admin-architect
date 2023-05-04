<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Button;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Link extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'button.link';
    }
}
