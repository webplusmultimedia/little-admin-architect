<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanHideOnForm
{
    protected bool $hideOnCreated = false;

    protected bool $hideOnUpdated = false;

    protected string $modeForm;

    public function hideOnCreate(): static
    {
        $this->hideOnCreated = true;

        return $this;
    }

    public function hideOnUpdate(): static
    {
        $this->hideOnUpdated = true;

        return $this;
    }

    public function isHiddenOnForm(): bool
    {
        if (Form::UPDATED === $this->modeForm) {
            return $this->hideOnUpdated;
        }

        return $this->hideOnCreated;
    }

    public function modeForm(string $mode): void
    {
        $this->modeForm = $mode;
    }
}
