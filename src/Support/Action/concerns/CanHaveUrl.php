<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait CanHaveUrl
{
    protected ?string $url = null;

    protected string $targetLink = '_self';

    public function url(string $url): static
    {
        $this->url = $url;
        $this->type = 'link';

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
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
