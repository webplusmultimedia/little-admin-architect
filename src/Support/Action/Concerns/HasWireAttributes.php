<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Action\Concerns;

trait HasWireAttributes
{
    protected ?string $livewireMethod = null;

    public function livewireMethod(string $livewireMethod): static
    {
        $this->livewireMethod = $livewireMethod;

        return $this;
    }

    public function getLivewireMethod(): ?string
    {
        return $this->livewireMethod;
    }
}
