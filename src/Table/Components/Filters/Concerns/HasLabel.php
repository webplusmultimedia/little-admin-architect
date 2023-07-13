<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns;

use Closure;

trait HasLabel
{
    protected Closure|string|null $label = null;

    protected function label(string|Closure $label): static
    {
        $this->label = $label;

        return $this;
    }
}
