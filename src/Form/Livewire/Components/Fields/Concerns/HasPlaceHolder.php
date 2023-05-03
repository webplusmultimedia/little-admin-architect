<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

Trait HasPlaceHolder
{
    protected ?string $placeHolder = NULL;

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
