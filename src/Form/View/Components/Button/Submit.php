<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Button;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Abstracts\AbstractComponent;

class Submit extends AbstractComponent
{
    protected function setViewPath(): string
    {
        return 'fields.button.submit';
    }

    protected function setUp(Field|AbstractLayout $field): void
    {
        // TODO: Implement setUp() method.
    }
}
