<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Actions\Concerns;

trait HasUrl
{
    protected ?string $url = null;

    protected string $type = 'button';

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

    public function getType(): string
    {
        return $this->type;
    }
}
