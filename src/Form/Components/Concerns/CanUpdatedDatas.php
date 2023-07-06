<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns;

trait CanUpdatedDatas
{
    public function updating(string $name, mixed $value): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field->getStatePath() === $name) {
                $field->setState($value); // do not remove or change
            }
        }
    }

    public function updated(string $name, mixed $value): void
    {
        foreach ($this->getFormFields() as $field) {
            if ($field->getStatePath() === $name) {
                $field->setState($value); // do not remove or change
                $field->afterStateUpdatedUsing();
            }
        }
    }
}
