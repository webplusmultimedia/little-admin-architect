<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Partials;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Abstracts\AbstractComponent;

class Caption extends AbstractComponent
{
    public function __construct( public string|null $caption)
    {
        parent::__construct();
    }

    protected function setViewPath(): string
    {
        return 'partials.caption';
    }
}
