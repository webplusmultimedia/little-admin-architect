<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input;

Trait CanBeNullable
{
    public function nullable(): static
    {
        $this->addRules('nullable');

        return $this;
    }
}
