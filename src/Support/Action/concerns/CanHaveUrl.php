<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

use Closure;

trait CanHaveUrl
{
    protected null|Closure|string $url = null;

    protected string $targetLink = '_self';

    public function url(Closure|string $url): static
    {
        $this->url = $url;
        $this->type = 'link';

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->evaluate($this->url);
    }

    public function targetLink(string $targetLink): static
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    public function blankTargetLink(): static
    {
        $this->targetLink = '_blank';

        return $this;
    }

    public function getTargetLink(): string
    {
        return $this->targetLink;
    }
}
