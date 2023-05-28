<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

trait HasModal
{
    protected bool $isModal = false;

    public function hasModal(): bool
    {
        return $this->isModal;
    }

    public function onModal(): static
    {
        $this->isModal = true;
        return $this;
    }
}
