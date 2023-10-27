<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanBeHidden
{
    protected bool | Closure $isHidden = false;

    public function hidden(bool | Closure $isHidden = true): static
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    public function isHidden(): bool
    {
        return $this->evaluate($this->isHidden);
    }
}
