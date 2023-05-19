<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait CanBeHidden
{
    protected bool $isHidden = false;

    public function hidden(bool $isHidden = true): static
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    public function isHidden(): bool
    {
        return $this->isHidden;
    }
}
