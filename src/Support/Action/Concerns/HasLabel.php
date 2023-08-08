<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

use Closure;

trait HasLabel
{
    protected string|Closure|null $label = null;

    protected bool $showLabel = true;

    public function label(string|Closure $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->evaluate($this->label);
    }

    public function hasLabel(): bool
    {
        return null !== $this->label;
    }

    public function showLabel(): bool
    {
        return $this->hasLabel() and $this->showLabel;
    }

    public function withoutLabel(): static
    {
        $this->showLabel = false;

        return $this;
    }
}
