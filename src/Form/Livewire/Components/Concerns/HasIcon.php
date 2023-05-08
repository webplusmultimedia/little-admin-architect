<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

trait HasIcon
{
    protected null|string $icon = null;

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
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
        return 'little-anonyme::form-components.fields.icons.'.$this->icon;
    }
}
