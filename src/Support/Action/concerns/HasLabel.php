<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Closure;

trait HasLabel
{
    protected string|Closure|null $label = null;

    public function label(string|Closure $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        if (is_callable($this->label)) {
            return call_user_func($this->label, $this->record);
        }

        return $this->label;
    }
}
