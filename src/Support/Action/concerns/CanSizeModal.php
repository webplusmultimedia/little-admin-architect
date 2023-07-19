<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait CanSizeModal
{
    protected string $maxWidth = 'modal__large';

    public function maxWidthSmall(): static
    {
        $this->maxWidth = 'modal__small';

        return $this;
    }

    public function maxWidthMedium(): static
    {
        $this->maxWidth = 'modal__medium';

        return $this;
    }

    public function getMaxWidth(): string
    {
        return $this->maxWidth;
    }
}
