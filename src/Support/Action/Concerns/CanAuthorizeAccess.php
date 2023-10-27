<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

use Closure;

trait CanAuthorizeAccess
{
    protected Closure | bool $authorize = true;

    public function can(Closure | bool $authorize): static
    {
        $this->authorize = $authorize;

        return $this;
    }

    public function authorizeAccess(): void
    {
        abort_unless($this->authorize(), 403);
    }

    public function authorize(): bool
    {
        return $this->evaluate($this->authorize);
    }
}
