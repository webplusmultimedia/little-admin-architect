<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Button;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;

class Submit extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'button.submit';
    }
}
