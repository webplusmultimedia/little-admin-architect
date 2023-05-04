<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Button;

use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Submit extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'button.submit';
    }
}
