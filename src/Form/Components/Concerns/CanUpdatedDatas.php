<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait CanUpdatedDatas
{
    public function updating(string $name, mixed $value): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field->getWireName() === $name) {
                $field->setState($value);
            }
        }
    }

    public function updated(string $name, mixed $value): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field->getWireName() === $name) {
                $field->setState($value);
                $field->afterStateUpdatedUsing();
            }
        }
    }
}
