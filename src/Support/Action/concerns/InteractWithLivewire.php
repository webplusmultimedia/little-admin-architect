<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\concerns;

trait InteractWithLivewire
{
    protected bool $isWireClick = false;

    protected ?string $wireClickAction = null;

    public function wireClick(string $wireAction): static
    {
        $this->isWireClick = true;
        $this->wireClickAction = $wireAction;

        return $this;
    }

    public function getWireClickAction(): ?string
    {
        return $this->wireClickAction;
    }
}
