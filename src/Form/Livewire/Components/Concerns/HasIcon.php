<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

trait HasIcon
{
    protected null|string $icon = null;

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function icon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasIcon(): bool
    {
        return null !== $this->icon;
    }

    public function getViewIcon()
    {
        return 'heroicon-' . $this->icon;
    }
}
