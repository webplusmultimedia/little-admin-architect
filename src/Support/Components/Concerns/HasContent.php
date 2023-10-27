<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns;

use Illuminate\Contracts\Support\Htmlable;

trait HasContent
{
    protected null | string | Htmlable $content = null;

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

    public function setMaxWidth(string $maxWidth): static
    {
        $this->maxWidth = $maxWidth;

        return $this;
    }

    public function content(null | string | Htmlable $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): null | string | Htmlable
    {
        return $this->content;
    }
}
