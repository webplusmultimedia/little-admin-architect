<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

use Closure;

trait HasAction
{
    protected ?Closure $action = null;

    public function action(Closure $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getAction(): ?Closure
    {
        return $this->action;
    }

    public function handleAction(): void
    {
        $this->evaluate(closure: $this->action);
    }
}
