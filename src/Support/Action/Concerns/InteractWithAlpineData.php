<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

trait InteractWithAlpineData
{
    protected bool $isAlpineDataClick = false;

    protected ?string $alpineDataClickAction = null;

    public function alpineDataClick(string $alpineDataAction): static
    {
        $this->isAlpineDataClick = true;
        $this->alpineDataClickAction = $alpineDataAction;

        return $this;
    }

    public function getAlpineDataClickAction(): ?string
    {
        return $this->alpineDataClickAction;
    }
}
