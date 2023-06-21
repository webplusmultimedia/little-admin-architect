<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanHydrate
{
    protected ?Closure $hydrate = null;

    public function afterStateHydrated(?Closure $hydrate): static
    {
        $this->hydrate = $hydrate;

        return $this;
    }

    public function hydrateState(): mixed
    {
        return $this->evaluate($this->hydrate);
    }
}
