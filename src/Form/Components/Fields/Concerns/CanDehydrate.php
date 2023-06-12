<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanDehydrate
{
    protected ?Closure $dehydrate = null;

    public function afterStateDehydratedUsing(?Closure $dehydrate): static
    {
        $this->dehydrate = $dehydrate;

        return $this;
    }

    public function dehydrateState(): ?Closure
    {
        return $this->evaluate($this->dehydrate, ['set', 'get']);
    }
}
