<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

class ToggleSwitch extends Checkbox
{
    protected function setViewPath(): string
    {
        $this->toggleSwitch = true;

        return 'toggle-switch';
    }
}
