<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait HasIcon
{
    protected string|null $icon = null;

    protected string  $iconPosition = 'before';

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): null|string
    {
        return $this->icon;
    }

    public function iconPositionAfter(): static
    {
        $this->iconPosition = 'after';

        return $this;
    }

    public function getIconPosition(): string
    {
        return $this->iconPosition;
    }
}
