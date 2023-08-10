<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

trait HasDefaultValue
{
    protected mixed $defaultValue = null;

    public function applyDefaultValue(): void
    {
        if ($this->defaultValue) {
            data_set($this->livewire, $this->getStatePath(), $this->defaultValue);
        }
    }

    public function default(mixed $value): static
    {
        $this->defaultValue = $value;

        return $this;
    }

    public function getDefaultValue(): mixed
    {
        return $this->defaultValue;
    }
}
