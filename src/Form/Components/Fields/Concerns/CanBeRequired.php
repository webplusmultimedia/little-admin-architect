<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanBeRequired
{
    protected bool | Closure $required = false;

    public function isRequired(): bool
    {
        return $this->evaluate($this->required);
    }

    public function required(bool | Closure $required = true): static
    {
        $this->required = $required;
        $this->addRules('required');

        return $this;
    }
}
