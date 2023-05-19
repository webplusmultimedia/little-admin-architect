<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Concerns;

trait HasDefaultValue
{
    protected mixed $defaultValue = null;

    public function applyDefaultValue(): void
    {
        if ($this->defaultValue and $this->record) {
            $this->record->{$this->name} = $this->defaultValue;
        }
    }

    public function default(mixed $value): static
    {
        $this->defaultValue = $value;

        return $this;
    }
}
