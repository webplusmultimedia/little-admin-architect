<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns;

trait HasFloatingLabel
{
    public function shouldDisplayFloatingLabel(): bool
    {
        return null === $this->floatingLabel
            ? config('little-admin-architect.floating_label', false)
            : $this->floatingLabel;
    }
}
