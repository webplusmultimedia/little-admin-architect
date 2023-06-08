<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Webplusmultimedia\LittleAdminArchitect\Support\Components\Modal\ConfirmationDialog;

trait CanRequireConfirmation
{
    protected bool $shouldRequireConfirmation = false;

    protected ?string $confirmQuestion = null;

    protected ConfirmationDialog $confirmationDialog;

    public function requireConfirmation(): static
    {
        $this->shouldRequireConfirmation = true;

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

    public function getConfirmQuestion(): ?string
    {
        return $this->confirmQuestion;
    }
}
