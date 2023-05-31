<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Concerns;

trait HasUrl
{
    protected ?string $url = null;

    /**
     * @return HasUrl
     */
    public function url(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
