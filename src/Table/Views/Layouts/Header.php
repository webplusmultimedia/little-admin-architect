<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Views\Layouts;

use Webplusmultimedia\LittleAdminArchitect\Table\Views\Layouts\Contracts\AbstractComponent;

class Header extends AbstractComponent
{
    protected string $viewPath = 'layout.header';
    public function __construct(
        protected \Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header $header
    ) {}


    public function getHeader(): \Webplusmultimedia\LittleAdminArchitect\Table\Components\Layouts\Header
    {
        return $this->header;
    }



}
