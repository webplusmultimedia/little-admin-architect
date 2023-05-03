<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\FieldException;

trait CanBeWireModifier
{
    protected null|string $wireModifier = NULL;

    public function wireModifier(string $modifier): static
    {
        if (! in_array($modifier, ['lazy', 'prevent', 'defer'])) {
            throw new FieldException('this wire modifier not exist for form');
        }
        $this->wireModifier = $modifier;

        return $this;
    }
}
