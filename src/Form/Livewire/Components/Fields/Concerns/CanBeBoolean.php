<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Input;

Trait CanBeBoolean
{
    /** Accepted input are true, false, 1, 0, "1", and "0" */
    public function boolean(): static
    {
        $this->addRules('boolean');

        return $this;
    }
}
