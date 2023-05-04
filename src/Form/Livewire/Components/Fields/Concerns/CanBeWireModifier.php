<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\FieldException;

trait CanBeWireModifier
{
    protected string $wireModifier = '.defer';

    public function lazy(): static
    {
        $this->wireModifier = '.lazy';

        return $this;
    }
    public function defer(): static
    {
        $this->wireModifier = '.defer';

        return $this;
    }

    public function getWireModifier(): string
    {
        return $this->wireModifier;
    }
}
