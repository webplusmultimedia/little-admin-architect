<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\ConfirmationDialog;

trait CanRequireConfirmation
{
    protected bool $shouldRequireConfirmation = false;

    protected ?string $confirmQuestion = null;

    protected ConfirmationDialog $confirmationDialog;

    public function requireConfirmation(bool $confirm = true): static
    {
        $this->shouldRequireConfirmation = $confirm;

        return $this;
    }

    public function isRequireConfirmation(): bool
    {
        return $this->shouldRequireConfirmation;
    }

    public function setConfirmationDialog(ConfirmationDialog $confirmationDialog): static
    {
        $this->confirmationDialog = $confirmationDialog;

        return $this;
    }

    public function confirmQuestion(?string $confirmQuestion): static
    {
        $this->confirmQuestion = $confirmQuestion;

        return $this;
    }

    public function getConfirmQuestion(): string
    {
        if ( ! $this->confirmQuestion) {
            $this->confirmQuestion = trans('little-admin-architect::action.question');
        }

        return $this->confirmQuestion;
    }
}
