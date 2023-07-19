<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Closure;

trait HasIcon
{
    protected string|Closure|null $icon = null;

    protected string $iconPosition = 'before';

    protected string $iconSize = 'w-4 h-4';

    public function icon(string|Closure $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): ?string
    {
        if (is_callable($this->icon)) {
            return call_user_func($this->icon, $this->record);
        }

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

    public function setIconSize(string $iconSize): static
    {
        $this->iconSize = $iconSize;

        return $this;
    }

    public function mediumIconSize(): static
    {
        $this->iconSize = 'w-6 h-6';

        return $this;
    }

    public function bigIconSize(): static
    {
        $this->iconSize = 'w-8 h-8';

        return $this;
    }

    public function getIconSize(): string
    {
        return $this->iconSize;
    }
}
