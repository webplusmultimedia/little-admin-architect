<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait CanBeNullable
{
    public function nullable(): static
    {
        $this->addRules('nullable');

        return $this;
    }
}
