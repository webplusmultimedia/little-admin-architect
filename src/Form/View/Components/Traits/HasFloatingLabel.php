<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Traits;

trait HasFloatingLabel
{
    public function shouldDisplayFloatingLabel(): bool
    {
        return is_null($this->floatingLabel)
            ? config('little-admin-architect.floating_label', false)
            : $this->floatingLabel;
    }
}
