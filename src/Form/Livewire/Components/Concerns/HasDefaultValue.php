<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Concerns;

use Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Fields\Field;

trait HasDefaultValue
{
    protected mixed $defaultValue = null;

    public function applyDefaultValue(): void
    {
        /** @var Field $field */
        foreach (static::getFormFields() as $field) {
            $field->applyDefaultValue();
        }
    }
}
