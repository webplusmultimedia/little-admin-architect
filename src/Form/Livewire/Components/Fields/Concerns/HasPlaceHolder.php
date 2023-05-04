<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasPlaceHolder
{
    protected ?string $placeHolder = null;

    public function getPlaceHolder(): ?string
    {
        return $this->placeHolder;
    }

    public function placeHolder(?string $placeHolder): static
    {
        $this->placeHolder = $placeHolder;

        return $this;
    }
}
