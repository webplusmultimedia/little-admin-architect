<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components;

class ToggleSwitch extends Checkbox
{
    protected function setViewPath(): string
    {
        $this->toggleSwitch = true;

        return 'toggle-switch';
    }
}
