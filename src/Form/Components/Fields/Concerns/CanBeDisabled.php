<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanBeDisabled
{
    protected bool|Closure $disabled = false;

    public function disabled(bool|Closure $canDisabled = true): static
    {
        $this->disabled = $canDisabled;

        return $this;
    }

    public function isDisabled(): bool
    {
        return $this->evaluate($this->disabled);
    }
}
