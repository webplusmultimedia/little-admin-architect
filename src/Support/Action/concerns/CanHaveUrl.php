<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait CanHaveUrl
{
    public ?string $url = null;

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
}
