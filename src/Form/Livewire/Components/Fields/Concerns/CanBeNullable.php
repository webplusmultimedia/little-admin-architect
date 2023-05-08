<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait CanBeNullable
{
    public function nullable(): static
    {
        $this->addRules('nullable');

        return $this;
    }
}
