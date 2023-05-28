<?php

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Concerns;

trait HasModal
{
    protected bool $isModal = false;

    protected function hasModal(): bool
    {
        return $this->isModal;
    }
}
