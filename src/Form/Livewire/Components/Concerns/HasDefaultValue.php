<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

trait HasDefaultValue
{
    protected mixed $defaultValue = null;

    public function applyDefaultValue(): void
    {
        foreach (static::getFormFields() as $field) {
            $field->applyDefaultValue();
        }
    }
}
