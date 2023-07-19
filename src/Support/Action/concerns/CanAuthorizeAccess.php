<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Closure;

trait CanAuthorizeAccess
{
    protected Closure|bool $authorize = true;

    public function can(Closure|bool $authorize): static
    {
        $this->authorize = $authorize;

        return $this;
    }

    public function authorizeAccess(): void
    {
        abort_unless($this->evaluate($this->authorize, include : ['record' => $this->record]), 403);
    }

    public function authorize(): bool
    {
        return $this->evaluate($this->authorize, include : ['record' => $this->record]);
    }
}
