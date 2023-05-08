<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait CanBeRequired
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
