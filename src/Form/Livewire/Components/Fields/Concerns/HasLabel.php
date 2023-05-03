<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasLabel
{
    public function label(null|string $label):static
    {
        $this->label = $label;
        return $this;
    }
    public function getLabel(): ?string
    {
        return $this->label;
    }
}
