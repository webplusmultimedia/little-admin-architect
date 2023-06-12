<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanDehydrate
{
    protected ?Closure $dehydrate = null;

    public function afterStateDehydratedUsing(Closure $dehydrate): static
    {
        $this->dehydrate = $dehydrate;

        return $this;
    }

    public function dehydrateState(): mixed
    {
        return $this->evaluate(closure: $this->dehydrate, excludes: ['set', 'get']);
    }
}
