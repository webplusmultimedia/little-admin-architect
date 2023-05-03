<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;

class ErrorMessage extends AbstractComponent
{
    public function __construct(public string|null $message)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.error-message';
    }
}
