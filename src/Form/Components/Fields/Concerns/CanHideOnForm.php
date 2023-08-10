<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanHideOnForm
{
    protected bool|Closure $hideOnCreated = false;

    protected bool|Closure $hideOnUpdated = false;

    protected string $statusForm = Form::CREATED;

    public function hideOnCreate(bool|Closure $hide = true): static
    {
        $this->hideOnCreated = $hide;

        return $this;
    }

    public function hideOnUpdate(bool|Closure $hide = true): static
    {
        $this->hideOnUpdated = $hide;

        return $this;
    }

    public function isHiddenOnForm(): bool
    {
        if (Form::UPDATED === $this->statusForm) {
            return $this->evaluate($this->hideOnUpdated);
        }

        return $this->evaluate($this->hideOnCreated);
    }

    public function statusForm(string $mode): void
    {
        $this->statusForm = $mode;
    }

    public function getStatusForm(): string
    {
        return $this->statusForm;
    }
}
