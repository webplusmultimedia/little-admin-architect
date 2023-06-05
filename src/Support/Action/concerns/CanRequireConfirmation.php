<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait CanRequireConfirmation
{
    protected bool $shouldRequireConfirmation = false;

    public function requireConfirmation(): static
    {
        $this->shouldRequireConfirmation = true;

        return $this;
    }

    public function isRequireConfirmation(): bool
    {
        return $this->shouldRequireConfirmation;
    }
}
