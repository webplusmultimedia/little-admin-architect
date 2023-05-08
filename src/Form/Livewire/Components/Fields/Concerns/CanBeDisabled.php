<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait CanBeDisabled
{
    protected bool $disabled = false;

    public function disabled(bool $canDisabled = true): static
    {
        $this->disabled = $canDisabled;

        return $this;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }
}
