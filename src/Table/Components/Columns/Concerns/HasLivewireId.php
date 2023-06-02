<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

trait HasLivewireId
{
    protected string $livewireId;

    public function livewireId(string $id): static
    {
        $this->livewireId = $id;

        return $this;
    }

    public function getLivewireId(): string
    {
        return $this->livewireId;
    }

    public function getWireId(): string
    {
        return str($this->getLabel())
            ->slug()
            ->prepend($this->getLivewireId(), '.')
            ->append('.', $this->getRecord()->getKey())
            ->value();
    }
}
