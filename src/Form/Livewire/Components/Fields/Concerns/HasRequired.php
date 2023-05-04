<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasRequired
{
    protected bool $required = false;

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function required(bool $required = true): static
    {
        $this->required = $required;
        $this->addRules('required');

        return $this;
    }
}
